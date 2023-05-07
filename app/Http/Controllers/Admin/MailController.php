<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AdminMail;
use DB;
use Exception;

class MailController extends Controller
{
    public function index()
    {
        $mails = AdminMail::all();

        return view('admin/mail/index', compact('mails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'     => 'required',
            'message'     => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('subject', 'message');

            AdminMail::create($data);

            DB::commit();
            return back()->with('success', 'Mail saved.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject'     => 'required',
            'message'     => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('subject', 'message');

            AdminMail::findOrFail($id)->update($data);

            DB::commit();
            return back()->with('success', 'Mail updated.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function destroy($id)
    {
        AdminMail::findOrFail($id)->delete();

        return back()->with('success', 'Mail deleted.');
    }
}
