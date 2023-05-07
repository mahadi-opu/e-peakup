<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use Hash;
use DB;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role_id', '!=', 0)->with('role')->get();
        $roles = Role::where('id', '!=', 1)->get();

        return view('admin/admin/index', compact('admins', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'phone'     => 'required|numeric',
            'role_id'   => 'required|exists:roles,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'email', 'password', 'phone', 'role_id');
            $data['password'] = Hash::make($data['password']);
            $data['customer_id'] = strtoupper(substr($data['name'], 0,1)).time();
            $data['email_verified_at'] = now();

            User::create($data);

            DB::commit();
            return back()->with('success', 'Admin saved.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required|numeric',
            'role_id'   => 'required|exists:roles,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'email', 'phone', 'role_id');
            $data['customer_id'] = strtoupper(substr($data['name'], 0,1)).time();

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $user = User::findOrFail($id);

            $user->update($data);

            DB::commit();
            return back()->with('success', 'Admin updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id != 1) {
            $user->delete();
        }

        return back()->with('success', 'Admin deleted.');
    }
}
