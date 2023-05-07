<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentMethod;
use App\Models\Service;
use DB;
use Exception;

class PaymentmethodController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $payment_methods = PaymentMethod::all();

        return view('admin/payment_method/index', compact('services', 'payment_methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'image'     => 'required|image',
            'service_id' => 'required|exists:services,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'image', 'service_id');

            if ($request->hasFile('image')) $data['image'] = $this->imageUpload($request->image, 'uploads/payment_methods/');

            PaymentMethod::create($data);

            DB::commit();
            return back()->with('success', 'Payment Method saved.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'image'     => 'required|image',
            'service_id' => 'required|exists:services,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'image', 'service_id');
            
            $method = PaymentMethod::findOrFail($id);

            $data['image'] = $method->image;
            if ($request->hasFile('image')) {
                if ($method && $method->image && file_exists($method->image)) unlink($method->image);
                $data['image'] = $this->imageUpload($request->image, 'uploads/payment_methods/');
            }

            $method->update($data);

            DB::commit();
            return back()->with('success', 'Payment Method updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        dd($id);
        $method = PaymentMethod::findOrFail($id);

        DB::beginTransaction();
        try {
            $method->delete();
            
            DB::commit();
            return back()->with('success', 'Payment Method deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
