<?php

namespace App\Modules\Auth\GoogleAuth;

use App\Http\Controllers\Controller as ControllersController;


use App\Modules\Auth\GoogleAuth\Actions\AuthRedirectForLogin;
use App\Modules\Auth\GoogleAuth\Actions\AuthCallBackAfterLogin;


class Controller extends ControllersController
{

    public function AuthRedirectForLogin()
    {
        $data = AuthRedirectForLogin::execute();
        return $data;
    }
    public function AuthCallBackAfterLogin()
    {
        $data = AuthCallBackAfterLogin::execute();
        return $data;
    }
}
