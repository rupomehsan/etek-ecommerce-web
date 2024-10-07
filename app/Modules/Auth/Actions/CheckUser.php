<?php

namespace App\Modules\Auth\Actions;
use App\Modules\UserManagement\User\Models\Model as UserModel;

class CheckUser
{
    public static function execute()
    {
        try {
            if (auth()->check()) {
                $user = UserModel::where('id', auth()->user()->id)
                    ->select([
                        'id','slug','name','email','phone_number','photo','role_id','role_serial'
                    ])
                    ->first();
                auth()->guard('web')->login($user, 1);
                $user->role = $user->role()->select('id','name','serial')->first();
                $user->user_delivery_address = $user->user_delivery_address()->where('is_default', 1)->first();
                return entityResponse($user);
            }
            return response()->json(["User not found"], 404);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
