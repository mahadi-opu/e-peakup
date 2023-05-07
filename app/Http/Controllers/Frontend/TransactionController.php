<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class TransactionController extends Controller
{
    public function paymentWithPoli($method)
    {
        $recipient  = session('recipient');
        $data       = session('data');
        $recipient['number'] = str_replace('+88', '', $recipient['number']);

        $mcode = 'S6104274';
        $acode = 'fT$7@8FyE!c5';

        $order_array = array(
            'Amount' => $data['grand_total'],
            'CurrencyCode' => 'AUD',
            'MerchantReference' => '88'.$recipient['number'],
            'MerchantHomepageURL' => url('/'),
            'SuccessURL' => route('frontend_payment_success', $method),
            'FailureURL' => route('frontend_payment_cancel'),
            'CancellationURL' => route('frontend_payment_cancel'),
        );

        $order_json = json_encode($order_array);
        $auth = base64_encode($mcode . ':' . $acode);
        $header = array(
            'Content-Type: application/json',
            'Authorization: Basic ' . $auth
        );

        $ch = curl_init( "https://poliapi.apac.paywithpoli.com/api/Transaction/Initiate" );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $order_json );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0 );
        curl_setopt( $ch, CURLOPT_REFERER, '' );//Set the referrer
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $response = curl_exec( $ch );
        curl_close( $ch );
        $json = json_decode( $response, true );

        $redirect_url = $json["NavigateURL"];

        return $redirect_url;
    }

    public static function paymentWithPaypal($method)
    {
        try {
            $data    = session('data');

            $gateway = Omnipay::create('PayPal_Rest');
            $gateway->setClientId(env('PAYPAL_CLIENT_ID'));
            $gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
            $gateway->setTestMode(env('PAYPAL_MODE', 'test') == 'test');

            $response = $gateway->purchase(array(
                'amount' => $data['grand_total'],
                'currency' => 'AUD',
                'returnUrl' => route('frontend_payment_success', $method),
                'cancelUrl' => route('frontend_payment_cancel'),
            ))->send();

            if ($response->isRedirect()) {
                return $response->redirect();
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function payWithStripe($stripe, $token)
    {
        $data    = session('data');

        try {
            $payment = Stripe::charges()->create([
                'amount'        => $data['grand_total'],
                'currency'      => 'AUD',
                'source'        => $token,
                'description'   => 'Quick Peakup',
                'receipt_email' => auth()->user()->email,
            ]);

            if ($payment) {
                return true;
            } else {
                return false;
            }
        } catch (CardErrorException $e) {
            dd($e);
        }
    }

}