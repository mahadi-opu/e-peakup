<?php

namespace App\Http\Controllers\Userpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\Order;
use App\Models\Recipient;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user                       = auth()->user();
        $user->country_name         = Country::findOrFail($user->country_id)->name;
        $user->transaction          = Order::where('user_id', $user->id)->count();
        $user->transaction_amount   = '$'.number_format(Order::where('user_id', $user->id)->sum('amount'), 2);
        $user->total_recipient      = Recipient::where('user_id', $user->id)->count();

        $filter                 = [];
        $filter['from_date']    = $request->from_date;
        $filter['to_date']      = $request->to_date;
        $filter                 = (object) $filter;

        $transactions               = Order::where('user_id', $user->id)
                                            ->when($filter->from_date && $filter->to_date, function ($query) use ($filter) {
                                                return $query->whereBetween('created_at', [$filter->from_date, $filter->to_date]);
                                            })
                                            ->with('recipient')
                                            ->latest()
                                            ->paginate(10);

        return view('frontend/userpanel/index', compact('user', 'transactions', 'filter'));
    }
}
