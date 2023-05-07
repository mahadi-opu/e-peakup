<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Frontend\TransactionController;
use App\Models\Recipient;
use App\Models\Order;
use App\Models\User;
use App\Models\Setting;
use App\Models\GlobalPayment;

use Mail;
use App\Mail\OrderShippedAdmin;
use App\Mail\OrderShippedUser;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

use DB;
use Exception;

class PaymentController extends Controller
{
    public function index()
    {
        $data       = session()->get('data');
        $recipient  = session()->get('recipient');
        if (!$data) {
            return redirect()->route('frontend_send')->with('danger', 'Please enter transaction information.');
        }

        $global_payments = GlobalPayment::where('status', 1)->get();

        return view('frontend/payment/index', compact('data', 'recipient', 'global_payments'));
    }

    public function store(Request $request)
    {
        $data       = (object) session('data');
        $recipient  = (object) session('recipient');
        if (!(array)$data) {
            return redirect()->route('frontend_send')->with('danger', 'Please enter transaction information.');
        }

        $request->validate([
            'payment_method' => 'required|integer',
        ]);

        try {
            $transaction = new TransactionController;

            if ($request->payment_method == 1) {
                $method = 'Poli';
                $payment = $transaction->paymentWithPoli($method);
                if ($payment) {
                    return redirect()->intended($payment);
                }
            } else if($request->payment_method == 2) {
                $method = 'Paypal';
                $payment = $transaction->paymentWithPaypal($method);
                if ($payment) {
                    return redirect()->intended($payment);
                }
            } else if($request->payment_method == 3 && $request->stripeToken) {
                $method = 'Stripe';
                $token = $request->stripeToken;
                $payment = $transaction->payWithStripe($method, $token);

                return redirect()->route('frontend_payment_success', $method);
            } else {
                dd('Sorry! Not available.');
            }

            DB::rollback();
            return redirect()->route('frontend_payment_cancel');
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('frontend_payment_cancel');
        }
    }

    public function success($method)
    {
        $data       = (object) session('data');
        $recipient  = (object) session('recipient');

        $recipient_exists = null;
        if ($recipient && isset($recipient->id)) {
            $recipient_exists = Recipient::find($recipient->id);
        }

        if (!$recipient_exists) {
            $recipient = Recipient::create([
                'user_id'       => auth()->user()->id,
                'country_id'    => 1,
                'name'          => $recipient->name,
                'number'        => '+88'.$recipient->number,
                'service_id'    => $data->service_id,
                'payment_method_id' => $data->payment_method_id,
                'account_type'  => $recipient->type['id'] ?? 0,
                'address'       => $recipient->address,
                'city'          => $recipient->city,
                'email'         => $recipient->email,
                'reason_id'     => $recipient->reason_id,
            ]);
        } else {
            $recipient_exists->update([
                'number'        => '+88'.$recipient->number,
                'service_id'    => $data->service_id,
                'payment_method_id' => $data->payment_method_id,
                'reason_id'     => $recipient->reason_id,
                'account_type'  => $recipient->type['id'] ?? 0,
            ]);
        }

        $order = Order::create([
            'order_id'      => strtoupper("od").time(),
            'country_id'    => 1,
            'user_id'       => auth()->user()->id,
            'payment_method_global' => $method,
            'recipient_id'  => $recipient->id,
            'reason_id'     => $recipient->reason_id,
            'service_id'    => $data->service_id,
            'payment_method_id' => $data->payment_method_id,
            'amount'        => $data->send,
            'recipient_amount' => $data->receive,
            'grand_total'   => $data->grand_total,
        ]);

        $user = auth()->user();

        if ($user->free_transaction) {
            $user->update([ 'free_transaction' => ($user->free_transaction - 1), ]);
        }

        if ($user->refer_id) {
            $referrer = User::findOrFail($user->refer_id);
            $referrer->update([ 'free_transaction' => (3 + $referrer->free_transaction), ]);

            $user->update([ 'refer_id' => 0, ]);
        }

        $setting = Setting::first();
        $order->rate = $setting->rate;

        Mail::to($order->user->email)->send(new OrderShippedUser($order));
        $support_mail = 'support@quickpeakup.com';
        Mail::to($support_mail)->send(new OrderShippedAdmin($order));

        session()->forget('data');
        session()->forget('recipient');

        return view('frontend/payment/success');
    }

    public function cancel(Request $request)
    {
        return view('frontend/payment/cancel');
    }
}
