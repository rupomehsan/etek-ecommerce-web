<?php

namespace App\Modules\Auth\FacebookAuth\Actions;

use App\Modules\UserManagement\User\Models\Model as User;
use Laravel\Socialite\Facades\Socialite;
use Inertia\Inertia;

class AuthCallBackAfterLogin
{
    public static function execute()
    {
        try {

            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // Create or update the user
            $user = User::updateOrCreate(
                ['provider_id' => $facebookUser->id],
                [
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'provider_type' => 'facebook',
                ]
            );

            if ($user) {

                $accessToken = $user->createToken('accessToken')->accessToken;

                auth()->guard('web')->login($user);

                return Inertia::render('Auth/OAuthRedirect', [
                    'token' => $accessToken,
                    'user' => $user->load('role')
                ]);


            } else {
                return messageResponse('Something went wrong', [], 400, 'error');
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
