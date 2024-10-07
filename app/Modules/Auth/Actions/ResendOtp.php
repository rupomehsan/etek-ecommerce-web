<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Validations\LoginValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResendOtp
{
    static $userModel = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute()
    {
        try {

            $requestData = request()->all();

            $user = self::$userModel::where('phone_number', $requestData['phone_number'])->first();

            if (!$user) {
                return messageResponse('User not found please register', $requestData, 400, 'error');
            }

            $otp = self::generateOTPCode();

            $isExist = DB::table('otp_codes')->where('phone_number', $requestData['phone_number'])->exists();
            if ($isExist) {
                DB::table('otp_codes')->where('phone_number', $requestData['phone_number'])->delete();
            }

            DB::table('otp_codes')->insert([
                'phone_number' => $requestData['phone_number'],
                'type' => 'login',
                'otp' => $otp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            SendOTPViaSMS($otp,$requestData['phone_number']);
            return messageResponse('Resend OTP successfully', ['phone_number' => $requestData['phone_number']]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
    public static function generateOTPCode()
    {
        return rand(100000, 9999999);
    }
}

