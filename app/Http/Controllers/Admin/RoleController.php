<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use DB;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('users')->get();

        return view('admin/role/index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name');

            Role::create($data);

            DB::commit();
            return back()->with('success', 'Role saved.');
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
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name');
            
            $role = Role::findOrFail($id);

            $role->update($data);

            DB::commit();
            return back()->with('success', 'Role updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $users = User::where('role_id', $id)->count();
        if ($users) {
            return back()->with('danger', 'Sorry! Admins exist under this role.');
        }

        DB::beginTransaction();
        try {
            $role->delete();
            
            DB::commit();
            return back()->with('success', 'Role deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
