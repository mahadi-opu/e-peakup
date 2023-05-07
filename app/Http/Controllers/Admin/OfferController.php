<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\PaymentMethod;
use DB;
use Exception;

class OfferController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        // $method_exists = Offer::pluck('payment_method_id')->toArray();
        $offers = Offer::latest()->get();

        return view('admin/offer/index', compact('payment_methods', 'offers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rate'  => 'required|numeric',
            'text'  => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('rate', 'text');

            Offer::create($data);

            DB::commit();
            return back()->with('success', 'Offer saved.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to save.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rate'  => 'required|numeric',
            'text'  => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only('rate', 'text');
            
            $offer = Offer::findOrFail($id);

            $offer->update($data);

            DB::commit();
            return back()->with('success', 'Offer updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to update.');
        }
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        DB::beginTransaction();
        try {
            $offer->delete();
            
            DB::commit();
            return back()->with('success', 'Offer deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Failed to delete.');
        }
    }
}
