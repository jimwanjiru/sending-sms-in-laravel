<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Infobip\Api\SmsApi;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Configuration;


class SmsController extends Controller
{
    public function loadPage(){
        return view('sms');
    }
    public function smsResults(){
        return view('results');
    }

    public function sendSms(Request $request){
        $configuration = new Configuration(
            host: env('INFOBIP_BASE_URL'),
            apiKey: env('INFOBIP_API_KEY')
        );

        $sendSms = new SmsApi(config: $configuration);


        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $request->phone)
            ],
            from: 'InfoSMS',
            text: $request->message
        );
        $req = new SmsAdvancedTextualRequest(
            messages: [$message]
        );

        try {
            $smsResponse = $sendSms->sendSmsMessage($req);
            return $smsResponse->getBulkId();
        } catch (ApiException $e) {
            return redirect('/sms')->with('fail', 'Message not sent');

        }
    }

}
