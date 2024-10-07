<?php

namespace App\Modules\Auth;

use App\Modules\Auth\Actions\Login;
use App\Modules\Auth\Actions\Register;
use App\Modules\Auth\Actions\RetailerRegister;
use App\Modules\Auth\Actions\VerifyOtp;
use App\Modules\Auth\Actions\ResendOtp;
use App\Modules\Auth\Actions\CheckUser;
use App\Modules\Auth\Actions\AuthCheck;

use App\Http\Controllers\Controller as ControllersController;
use App\Modules\Auth\Validations\LoginValidation;
use App\Modules\Auth\Validations\RegisterValidation;
use App\Modules\Auth\Validations\RetailerRegisterValidation;
use App\Modules\Auth\Validations\OTPValidation;


class Controller extends ControllersController
{

    public function login(LoginValidation $request)
    {
        $data = Login::execute($request);
        return $data;
    }
    public function SendOtp(RegisterValidation $request)
    {
        $data = Register::generateOTP($request);
        return $data;
    }
    public function ResendOtp()
    {
        $data = ResendOtp::execute();
        return $data;
    }
    public function VerifyOtp(OTPValidation $request)
    {
        $data = VerifyOtp::execute($request);
        return $data;
    }

    public function checkUser()
    {
        $data = CheckUser::execute();
        return $data;
    }
    public function authCheck()
    {
        $data = AuthCheck::execute();
        return $data;
    }
    public function RetailerRegister(RetailerRegisterValidation $request)
    {
        $data = RetailerRegister::execute($request);
        return $data;
    }
}
