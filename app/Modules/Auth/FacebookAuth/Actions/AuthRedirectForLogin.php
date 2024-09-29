<?php

namespace App\Modules\Auth\FacebookAuth\Actions;

use Laravel\Socialite\Facades\Socialite;

class AuthRedirectForLogin
{
    public static function execute()
    {
        try {
            return Socialite::driver('facebook')->redirect();
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
