<?php

use App\Mail\OrderSuccessEmail;
use App\Mail\OtpEmail;
use Illuminate\Support\Facades\Mail;

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function SendOTPViaEmail($email, $subject, $otp)
{
    try {
        if (isValidEmail($email)) {
            Mail::to($email)
                ->send(new OtpEmail($otp, $subject));
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}
