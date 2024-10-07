<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Validations\RegisterValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Register
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function generateOTP(RegisterValidation $request)
    {
        try {
            $requestData = $request->validated();

            $isUserExist = self::$model::where('phone_number', $requestData['phone_number'])->exists();

            if ($isUserExist) {
                return messageResponse('Sorry,this phone number already exist', [], 400, 'error');
            }

            $otp = self::generateOTPCode();
            $isExist = DB::table('otp_codes')->where('phone_number', $requestData['phone_number'])->exists();

            if ($isExist) {
                DB::table('otp_codes')->where('phone_number', $requestData['phone_number'])->delete();
            }

            DB::table('otp_codes')->insert([
                'phone_number' => $requestData['phone_number'],
                'otp' => $otp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            try {
                SendOTPViaSMS($requestData['phone_number'], $otp);
            } catch (\Throwable $th) {
                //throw $th;
            }

            return messageResponse('OTP sent successfully', [
                'name' => $requestData['name'],
                'phone_number' => $requestData['phone_number'],
                'otp' => $otp
            ]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    public static function generateOTPCode()
    {
        return rand(100000, 9999999);
    }
}








// $user = self::$model::create($requestData);
// $data['access_token'] = $user->createToken('accessToken')->accessToken;
// $data['user'] = $user;
// return messageResponse('Successfully Registered', $data, 200, 'success');
