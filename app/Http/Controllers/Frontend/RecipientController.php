<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\PaymentMethod;
use App\Models\Reason;
use App\Models\Type;
use App\Models\Recipient;

class RecipientController extends Controller
{
    public function add(Request $request)
    {
        $data       = session('data');
        $data['payment_method']['regex'] = '^(?:\+88|88)?(01[3-9]\d{8})$';

        if ($data['payment_method']['id'] == 4) {
            $data['payment_method']['regex'] = '^(?:\+88|88)?(017\d{8})$';
        } else if ($data['payment_method']['id'] == 5) {
            $data['payment_method']['regex'] = '^(?:\+88|88)?(018\d{8})$';
        } else if ($data['payment_method']['id'] == 6) {
            $data['payment_method']['regex'] = '^(?:\+88|88)?(015\d{8})$';
        } else if ($data['payment_method']['id'] == 7) {
            $data['payment_method']['regex'] = '^(?:\+88|88)?(016\d{8})$';
        } else if ($data['payment_method']['id'] == 8) {
            $data['payment_method']['regex'] = '^(?:\+88|88)?(019\d{8})$';
        }

        if (!$data) {
            return redirect()->route('frontend_send')->with('danger', 'Please enter transaction information.');
        }
        $reasons    = Reason::all();
        $types      = Type::all();

        // Recipient Exists
        $recipient = null;
        if ($request->recipient_exist && session('recipient')) {
            $recipient                                      = session('recipient');

            $session_data                                   = session()->get('data');
            $session_data['additional_charge_percentage']   = $recipient['type'] && $recipient['type']['percentage'] ? $recipient['type']['percentage'] : 0;
            $session_data['grand_total']                    = $session_data['total_with_fee'] * (1 + $session_data['additional_charge_percentage']/100);

            session()->put('data', $session_data);
            $recipient->number = str_replace('+88', '', $recipient['number']);
        }
        $recipient_exist = $request->recipient_exist ? true : false;

        return view('frontend/recipient/add', compact('data', 'reasons', 'types', 'recipient', 'recipient_exist'));
    }

    public function save(Request $request)
    {
        $session_data = session('data');

        $request->validate([
            'number'    => 'required|numeric|min:11|confirmed|regex:/^([0-9\s\-\+\(\)]*)$/',
            'type_id'   => 'exists:types,id',
            'name'      => 'required',
            'email'     => 'required|email',
            'address'   => 'required',
            'city'      => 'required',
            'reason_id' => 'required|exists:reasons,id',
            'agree'     => 'required',
        ]);

        $data               = $request->only('number', 'name', 'email', 'address', 'city', 'reason_id');
        $session_recipient = session('recipient');

        if (isset($session_recipient->id) && $session_recipient->id) {
            $data['id'] = $session_recipient->id;
        }

        $data['type']       = null;
        if ($request->type_id) {
            $data['type']   = Type::where('id', $request->type_id)->first()->toArray();
        }

        $session_data                                   = session()->get('data');
        $session_data['additional_charge_percentage']   = $data['type'] && $data['type']['percentage'] ? $data['type']['percentage'] : 0;
        $session_data['grand_total']                    = $session_data['total_with_fee'] * (1 + $session_data['additional_charge_percentage']/100);

        session()->put('data', $session_data);
        session()->put('recipient', $data);

        return redirect()->route('frontend_recipient_preview');

    }

    public function preview()
    {
        $recipient = session()->get('recipient');
        $data      = session()->get('data');
        if (!$data) {
            return redirect()->route('frontend_send')->with('danger', 'Please enter transaction information.');
        }
        
        return view('frontend/recipient/preview', compact('data', 'recipient'));
    }
}
