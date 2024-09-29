<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Validations\LoginValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute(LoginValidation $request)
    {
        try {
            // dd($request->all());
            $requestData = $request->validated();

            $user = self::$model::with('role')->where('status', 'active')->where('phone_number', $requestData['phone_number'])->first();

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

            SendOTPViaSMS($otp, $requestData['phone_number']);

            return messageResponse('OTP sent successfully', [
                'phone_number' => $requestData['phone_number'],
                'otp' => $otp,
                'user_type' => $user->role->name
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

// $check_auth_user = self::$model::where('email', $request->email)->first();

// if ($check_auth_user->is_blocked) {
//     return response()->json(['status' => 'error', 'message' => 'Sorry,you are blocked'], 404);
// }

// if ($check_auth_user->is_blocked) {
//     return response()->json(['status' => 'error', 'message' => 'Sorry,you are blocked'], 404);
// }


// $check_auth_user = self::$model::where('status', 'active')->whereAny(['user_name', 'email', 'phone_number'], request()->email)->first();
// if ($check_auth_user && Hash::check($request->password, $check_auth_user->password)) {
//     DB::table('oauth_access_tokens')->where("user_id", $check_auth_user->id)->update(['revoked' => 1]);
//     $data['access_token'] = $check_auth_user->createToken('accessToken')->accessToken;
//     $data['user'] = $check_auth_user;
//     return messageResponse('Successfully Loged In', $data, 200, 'success');
// } else {
//     return response()->json(['status' => 'error', 'message' => 'Sorry,user not found'], 404);
// }
