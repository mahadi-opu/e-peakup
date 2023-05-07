<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\User;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['pending_orders'] = Order::where('status', 0)->count();
        $data['succeed_orders'] = Order::where('status', 1)->count();
        $data['total_orders']   = Order::count();
        $data['verified_users'] = User::where('email_verified_at', '!=', null)->count();
        $data['total_refers']   = User::sum('refers');
        $data['rate']           = Setting::first()->rate;
        $data = (object) $data;

        $amounts        = [];
        for ($i=0; $i <= 12; $i++) { 
            $amounts[]      = Order::whereMonth('created_at', $i)->sum('amount');
        }

        return view('admin/dashboard', compact('data', 'amounts'));
    }
}
