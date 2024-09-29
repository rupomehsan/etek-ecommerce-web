<?php

namespace App\Modules\Auth\Actions;


class RemoveAccount
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    public static function execute()
    {
        try {
            $user = self::$model::where('id', auth()->id())->first();
            if ($user) {
                $user->status = 'inactive';
                $user->update();
                return messageResponse('User successfully removed', [], 201, 'success');
            } else {
                return messageResponse('User not found please register', [], 400, 'error');
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
