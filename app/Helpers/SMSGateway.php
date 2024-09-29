<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

/**
 * ```js
  sendOTP($otp,$number)
 */
function SendOTPViaSMS($otp, $number)
{
    // dd($otp, $number);
    try {
        $smsConfigModel = \App\Modules\ConfigurationManagement\SMSConfiguration\Models\Model::class;
        $smsConfig = $smsConfigModel::where('is_active', 1)->first();
        if (strtoupper($smsConfig->sms_provider) == 'URCL') {
            if ($smsConfig) {
                $sms_gateway_url = $smsConfig->sms_gateway_url;
                $key = $smsConfig->api_key;
                $message = "Your OTP from etek : " . $otp;
                if (preg_match('/^01[1-9]/', $number)) {
                    $number = '+880' . ltrim($number, '0');
                }

                $url = "$sms_gateway_url?api_key=$key&type=text&phone=$number&senderid=URCL&message=$message";
                $res = Http::get($url);
            }
        } else if (strtoupper($smsConfig->sms_provider) == 'TWILO') {
            if ($smsConfig) {
                $sms_gateway_url = $smsConfig->sms_gateway_url;
                $key = $smsConfig->api_key;
                $message = "Your OTP from etek : " . $otp;
                if (preg_match('/^01[1-9]/', $number)) {
                    $number = '+880' . ltrim($number, '0');
                }

                $sid = $smsConfig->caller_id;
                $token = $smsConfig->api_key;
                $twilioPhoneNumber = $smsConfig->caller_phone_number;

                $url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json?To=$number&From=$twilioPhoneNumber&Body=$message&$sid:$token";
                $res = Http::get($url);
            }
        }
    } catch (\Exception $e) {
        // dd($e->getMessage());
    }
}
