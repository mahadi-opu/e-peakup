<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'bail|required',
            'new_password' => 'bail|required|min:6'
        ]);

        $admin = auth()->user();
        if (Hash::check($request->old_password, $admin->password)) {
            $admin->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Password updated successfully!');
        }
        else {
            return back()->withInput($request->all())->with('danger', 'Old Password is incorrect');
        }
    }
}
