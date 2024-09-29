<?php

namespace App\Modules\Auth\FacebookAuth;

use App\Http\Controllers\Controller as ControllersController;


use App\Modules\Auth\FacebookAuth\Actions\AuthRedirectForLogin;
use App\Modules\Auth\FacebookAuth\Actions\AuthCallBackAfterLogin;


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
