<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;


use Illuminate\Support\Facades\Hash;

class ChangePassword
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute($request)
    {
        try {
            $authUser = auth()->user();
            $user = self::$model::where('email', $authUser->email)->first();

            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->update();
                return messageResponse('Password updated successfully');
            } else {
                return messageResponse('Password didn`t match ',[], 404, 'error');
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
