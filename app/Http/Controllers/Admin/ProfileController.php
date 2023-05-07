<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin/profile/index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('image');

            if ($request->hasFile('image')) {
                if (auth()->user()->image) {
                    unlink(auth()->user()->image);
                }
                $data['image'] = $this->imageUpload($request->image, 'uploads/admins/');
            }

            auth()->user()->update($data);

            DB::commit();
            return back()->with('success', 'Profile saved.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to save.');
        }
    }
}
