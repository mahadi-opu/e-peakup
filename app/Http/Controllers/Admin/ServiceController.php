<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\Service;
use DB;
use Exception;

class ServiceController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $services = Service::all();

        return view('admin/service/index', compact('services', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'charge'    => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'charge', 'country_id');

            Service::create($data);

            DB::commit();
            return back()->with('success', 'Service saved.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'charge'    => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'charge', 'country_id');
            
            $service = Service::findOrFail($id);

            $service->update($data);

            DB::commit();
            return back()->with('success', 'Service updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        dd($id);
        $service = Service::findOrFail($id);

        DB::beginTransaction();
        try {
            $service->delete();
            
            DB::commit();
            return back()->with('success', 'Service deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
