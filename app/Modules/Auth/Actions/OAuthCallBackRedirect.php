<?php

namespace App\Modules\Auth\Actions;

use App\Modules\UserManagement\User\Models\Model as User;
use Laravel\Socialite\Facades\Socialite;

class OAuthCallBackRedirect
{
    public static function execute()
    {
        try {

            // Create or update the user
            $user = User::updateOrCreate(
                [
                    'provider_id' => request()->input('provider_id'),
                    'provider_type' => request()->input('provider_type'),
                ],
                [
                    'name' => request()->input('name'),
                    'email' => request()->input('email'),
                    'provider_type' => request('provider_type'),
                    'photo' => request()->input('photo'),
                ]
            );

            if ($user) {

                $accessToken = $user->createToken('accessToken')->accessToken;

                auth()->guard('web')->login($user);

                return response([
                    'access_token' => $accessToken,
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
