<?php

namespace App\Http\Controllers\Userpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use Hash;
use DB;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        $user               = auth()->user();
        $user->country_name = Country::findOrFail($user->country_id)->name;

        return view('frontend/userpanel/profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required|numeric|min:10',
            'gender'    => 'required|in:m,f',
            'address'   => 'required',
            'image'     => 'image',
        ]);

        DB::beginTransaction();

        try {

            $data = $request->only('name', 'email', 'phone', 'gender', 'address');

            $data['image'] = auth()->user()->image;
            if ($request->hasFile('image')) {
                if($data['image']) unlink($data['image']);
                $data['image'] = $this->imageUpload($request->image, 'uploads/users/');
            }

            auth()->user()->update($data);

            DB::commit();
            return back()->with('success', 'Profile updated');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('success', 'Failed to update.');
        }

    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        DB::beginTransaction();

        try {

            $user = auth()->user();

            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                DB::commit();
                return back()->with('success', 'Password Updated successfully!');
            }
            else {
                DB::rollback();
                return back()->with('danger', 'Old Password is incorrect.');
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('success', 'Failed to update.');
        }
    }

    public function profileThumb(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        try {
            $image = auth()->user()->image;
            if ($request->hasFile('image')) {
                if($image) unlink($image);
                $image = $this->imageUpload($request->image, 'uploads/users/');
            }

            auth()->user()->update([
                'image' => $image,
            ]);

            return back()->with('success', 'Profile Picture Changed!');
        } catch (Exception $e) {
            return back()->with('danger', 'Sorry! Something went wrong.');
        }
    }
}
