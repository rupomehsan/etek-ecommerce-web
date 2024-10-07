<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Validations\LoginValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VerifyOtp
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $UserRetailerInformationModel = \App\Modules\UserManagement\User\Models\UserRetailerInformationModel::class;

    public static function execute($request)
    {
        try {

            $requestData = $request->validated();
            $otpRecord = DB::table('otp_codes')
                ->where('phone_number', $requestData['phone_number'])
                ->where('otp', $requestData['otp'])
                ->latest('created_at')
                ->first();

            if (!$otpRecord) {
                return messageResponse('Invalid OTP', $requestData, 400, 'error');
            }
            // Proceed with user registration
            unset($requestData['otp']);
            $user = self::$model::where('phone_number', $requestData['phone_number'])->first();
            $data = [];
            if ($user) {
                $data['access_token'] = $user->createToken('accessToken')->accessToken;
                $data['user'] =  $user->load('role');
            } else {
                if ($request->type == 'retailer') {
                    $requestData['role_id'] = config('role.retailer');
                    if ($user = self::$model::create($requestData)) {
                        $retailerData = [
                            'user_id' => $user->id,
                            'shop_name' => $request->shop_name,
                            'license_number' => $request->license_number
                        ];
                        self::$UserRetailerInformationModel::create($retailerData);
                        $data['access_token'] = $user->createToken('accessToken')->accessToken;
                        $data['user'] =  $user->load('role');
                    }
                } else {
                    $requestData['role_id'] = config('role.customer');
                    $user = self::$model::create($requestData);
                    $data['access_token'] = $user->createToken('accessToken')->accessToken;
                    $data['user'] = $user->load('role');
                }
            }

            auth()->guard('web')->login($user, 1);
            // request()->session()->regenerate();

            return messageResponse('Your OTP successfully Matched', $data, 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
