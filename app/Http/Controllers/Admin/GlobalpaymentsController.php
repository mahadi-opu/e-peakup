<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GlobalPayment;
use DB;
use Exception;

class GlobalpaymentsController extends Controller
{
    public function index()
    {
        $global_payments = GlobalPayment::all();

        return view('admin/global_payments/index', compact('global_payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'image'     => 'required|image',
            'status'    => 'boolean',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'status');
            $data['status'] = $data['status'] ?? 0;

            if ($request->hasFile('image')) $data['image'] = $this->imageUpload($request->image, 'uploads/global_payments/');

            GlobalPayment::create($data);

            DB::commit();
            return back()->with('success', 'Image saved.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required',
            'image'     => 'image',
            'status'    => 'boolean',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'status');
            $data['status'] = $data['status'] ?? 0;
            
            $gallery = GlobalPayment::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($gallery && $gallery->image && file_exists($gallery->image)) unlink($gallery->image);
                $data['image'] = $this->imageUpload($request->image, 'uploads/global_payments/');
            }

            $gallery->update($data);

            DB::commit();
            return back()->with('success', 'Image updated.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        $gallery = GlobalPayment::findOrFail($id);

        DB::beginTransaction();
        try {
            if ($gallery && $gallery->image && file_exists($gallery->image)) unlink($gallery->image);
            $gallery->delete();
            
            DB::commit();
            return back()->with('success', 'Image deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }

}
