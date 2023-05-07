<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use DB;
use Exception;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return view('admin/country/index', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name');

            Country::create($data);

            DB::commit();
            return back()->with('success', 'Country saved.');
        } catch (Exception $e) {
            DB::rollBack();
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
            
            $country = Country::findOrFail($id);

            $country->update($data);

            DB::commit();
            return back()->with('success', 'Country updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        dd($id);
        $country = Country::findOrFail($id);

        DB::beginTransaction();
        try {
            $country->delete();
            
            DB::commit();
            return back()->with('success', 'Country deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
