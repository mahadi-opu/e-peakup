<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AdminMail;
use App\Models\Recipient;
use App\Models\Order;

use DB;
use Exception;

use Mail;
use App\Mail\UserMail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 0)->latest()->get();
        $mails = AdminMail::all();

        return view('admin/users/index', compact('users', 'mails'));
    }

    public function sendMail(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user = User::findOrFail($id);
        $data = $request->all();

        Mail::to($user->email)->send(new UserMail($data));

        return back()->with('success', 'Mail sent!');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            if ($user) {
                Order::where('user_id', $id)->delete();
                Recipient::where('user_id', $id)->delete();
                $user->delete();
            }

            DB::commit();
            return back()->with('success', 'User deleted along with his Orders and Recipients!');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('danger', 'Something went wrong.');
        }
    }
}
