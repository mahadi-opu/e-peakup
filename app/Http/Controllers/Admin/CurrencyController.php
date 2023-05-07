<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\Currency;
use DB;
use Exception;

class CurrencyController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $currencies = Currency::with('country')->get();

        return view('admin/currency/index', compact('countries', 'currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'short_name' => 'required',
            'rate' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'short_name', 'rate', 'country_id');

            Currency::create($data);

            DB::commit();
            return back()->with('success', 'Currency saved.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'short_name' => 'required',
            'rate' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('name', 'short_name', 'rate', 'country_id');
            
            $currency = Currency::findOrFail($id);

            $currency->update($data);

            DB::commit();
            return back()->with('success', 'Currency updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        dd($id);
        $currency = Currency::findOrFail($id);

        DB::beginTransaction();
        try {
            $currency->delete();
            
            DB::commit();
            return back()->with('success', 'Currency deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
