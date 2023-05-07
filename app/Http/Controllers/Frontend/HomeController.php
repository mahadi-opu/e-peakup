<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Recipient;
use App\Models\Service;
use App\Models\PaymentMethod;
use App\Models\GlobalPayment;
use App\Models\FAQ;
use App\Models\Setting;
use App\Models\Notice;
use App\Models\Offer;

class HomeController extends Controller
{
    public function index()
    {
        $data   = Setting::select('rate', 'youtube_homepage')->first();
        $data->youtube_homepage = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1", $data->youtube_homepage);

        $sliders = Notice::where('status', 1)->get();

        $operators = PaymentMethod::all();
        $payment_methods = GlobalPayment::where('status', 1)->get();

        $services           = Service::all();

        $offer = Offer::first();

        return view('frontend/index', compact('data', 'sliders', 'operators', 'payment_methods', 'services', 'offer'));
    }

    public function send(Request $request)
    {
        $data = Setting::select('rate', 'youtube_send_money')->first();
        $data['recipient_exist'] = false;

        if (isset($request->recipient_id) && $request->recipient_id) {
            $request->validate([
                'recipient_id' => 'exists:recipients,id'
            ]);

            $recipient = Recipient::with('recipient_account_type')->find($request->recipient_id);
            session()->put('recipient', $recipient);

            $data['recipient_exist'] = true;
        }

        $request->validate([
            'send' => 'numeric',
        ]);
        
        $data->youtube_send_money = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1", $data->youtube_send_money);

        if (count($request->all())) {
            $data['send']       = $request->send;
            $data['receive']    = $data['rate'];
            if ($data['send']) {
                $data['receive'] = $data['send'] * $data['rate'];
                $data['receive'] = number_format($data['receive'], 2);
            }
        }
        $data = (object) $data;

        $services           = Service::all();

        return view('frontend/send', compact('data', 'services'));
    }

    public function sendPost(Request $request)
    {
        $request->validate([
            'send'              => 'required|numeric',
            'service_id'        => 'required|exists:services,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $setting = Setting::first();

        $data                       = $request->only('send', 'service_id', 'payment_method_id');
        
        $data['service']            = Service::where('id', $request->service_id)->first()->toArray();
        $data['payment_method']     = PaymentMethod::where('id', $request->payment_method_id)->first()->toArray();
        $data['rate']               = $setting->rate;
        $data['show_type_status']   = $request->service_id == 1 ? true : false;
        $data['receive']            = ($data['send'] * $data['rate']);
        
        $user = auth()->user();
        if ($user->free_transaction) {
            $data['fee']            = 0;
        } else {
            $data['fee']            = $data['service']['charge'];
        }

        $data['total_with_fee']     = ($data['send'] + $data['fee']);

        session()->put('data', $data);

        return redirect()->route('frontend_recipient_add', ['recipient_exist' => $request->recipient_exist]);
    }

    public function howItWorks()
    {
        return view('frontend/how_it_works');
    }

    public function help()
    {
        $faqs = FAQ::where('status', 1)->get();
        
        return view('frontend/help', compact('faqs'));
    }

    public function aboutUs()
    {
        return view('frontend/about');
    }

    public function terms()
    {
        return view('frontend/terms');
    }

    public function privacy()
    {
        return view('frontend/privacy');
    }
}
