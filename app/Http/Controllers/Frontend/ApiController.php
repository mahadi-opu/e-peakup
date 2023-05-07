<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\PaymentMethod;
use App\Models\Order;
use App\Models\User;

class ApiController extends Controller
{
    public function paymentMethods(Request $request)
    {
        $service = Service::select('id', 'name', 'charge')->findOrFail($request->service_id);
        
        $user = auth()->user();
        if ($user && $user->free_transaction) {
            $service->charge = 0;
        }

        $payment_methods = PaymentMethod::where('service_id', $request->service_id)->select('id', 'name', 'image')->get();

        return ['service' => $service, 'payment_methods' => $payment_methods];
    }
}
