<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notice;
use DB;
use Exception;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();

        return view('admin/notice/index', compact('notices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'notice'     => 'required|image',
            'status'     => 'boolean',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('notice');
            $data['status'] = $request->status ? 1 : 0;

            if ($request->hasFile('notice')) $data['notice'] = $this->imageUpload($request->notice, 'uploads/notices/');

            Notice::create($data);

            DB::commit();
            return back()->with('success', 'Slider saved.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'notice'     => 'image',
            'status'     => 'boolean',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('notice');
            $data['status'] = $request->status ? 1 : 0;

            $notice = Notice::findOrFail($id);
            $data['notice'] = $notice->notice;
            if ($request->hasFile('notice')) {
                if ($notice && $notice->notice && file_exists($notice->notice)) unlink($notice->notice);
                $data['notice'] = $this->imageUpload($request->notice, 'uploads/notices/');
            }

            $notice->update($data);

            DB::commit();
            return back()->with('success', 'Slider updated.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        DB::beginTransaction();
        try {
            if ($notice && $notice->notice && file_exists($notice->notice)) unlink($notice->notice);
            $notice->delete();
            
            DB::commit();
            return back()->with('success', 'Slider deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
