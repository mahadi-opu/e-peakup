<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use Mail;
use App\Mail\OrderShipped;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $selected_status = $request->status ?? 0;
        $status_selected = isset($request->status) ? true : false;

        $orders = Order::when($status_selected, function ($query) use ($request) {
                            return $query->where('status', $request->status);
                        })
                        ->has('recipient.recipient_account_type')
                        ->with('user', 'recipient', 'recipient.recipient_account_type', 'reason', 'service', 'payment_method')
                        ->latest()
                        ->get();

        return view('admin/order/index', compact('orders', 'selected_status', 'status_selected'));
    }

    public function done(Request $request)
    {
        Order::findOrFail($request->order_id)->update([
            'status' => 1
        ]);
        
        return back()->with('success', 'Order marked as confirmed.');
    }

    public function mailSend($id)
    {
        $order = Order::with('user', 'recipient', 'reason', 'service', 'payment_method')->findOrFail($id);

        Mail::to($order->user->email)->send(new OrderShipped($order));

        return back()->with('success', 'Mail sent!');
    }
}
