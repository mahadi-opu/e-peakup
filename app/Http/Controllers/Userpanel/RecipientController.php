<?php

namespace App\Http\Controllers\Userpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Recipient;
use App\Models\Country;
use App\Models\Order;

class RecipientController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->country_name         = Country::findOrFail($user->country_id)->name;
        $user->transaction          = Order::where('user_id', $user->id)->count();
        $user->transaction_amount   = '$'.number_format(Order::where('user_id', $user->id)->sum('amount'), 2);
        $user->total_recipient      = Recipient::where('user_id', $user->id)->count();

        $recipients                 = Recipient::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('frontend/userpanel/recipient', compact('recipients', 'user'));
    }
}
