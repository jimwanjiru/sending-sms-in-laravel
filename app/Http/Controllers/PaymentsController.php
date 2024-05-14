<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function token(){
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');

        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $response = http::withBasicAuth($consumerKey, $consumerSecret)
            ->get($url);
        
        return $response->successful() ? $response['access_tonek'] : 'Failed to generate token';    
    }

    public function simulate(Request $request){
        $accessToken = $this->token();

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $Passkey = env('MPESA_PASSKEY');
        $BusinessShortCode = env('MPESA_SHORTCODE');
        $PartyA = $request->phone;
        $AccountReference = 'Test';
        $TransactionDesc = 'Test';
        $Amount = $request->amount;
        $PhoneNumber = $request->phone;
        $CallBackURL = 'https://mycallbackurl.com';
        $Timestamp = Carbon::now()->format('YmdHis');
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

        $response = Http::withToken($accessToken)
            ->post($url, [
                'BusinessShortCode' => $BusinessShortCode,
                'Password' => $Password,
                'Timestamp' => $Timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $Amount,
                'PartyA' => $PartyA,
                'PartyB' => $BusinessShortCode,
                'PhoneNumber' => $PhoneNumber,
                'CallBackURL' => $CallBackURL,
                'AccountReference' => $AccountReference,
                'TransactionDesc' => $TransactionDesc
            ]);

        return $response->successful() ? $response : 'Failed to simulate payment';

    }
}
