<?php

namespace App\Modules\UserManagement\User\Actions\Customer;



class AccountInfoUpdate
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute($request)
    {
        try {
            //    dd($request->all(),auth()->user()->id);
            $requestData = $request->validated();
            if (!$userData = self::$model::find(auth()->id())) {
                return messageResponse('User not found...', [], 404, 'error');
            }

            $userData->update($requestData);
            return messageResponse('Account info updated', $userData, 201, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
