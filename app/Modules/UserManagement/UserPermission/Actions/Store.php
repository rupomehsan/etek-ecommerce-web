<?php

namespace App\Modules\UserManagement\UserPermission\Actions;

use App\Modules\UserManagement\UserPermission\Validations\Validation;


class Store
{
    static $model = \App\Modules\UserManagement\UserPermission\Models\Model::class;

    public static function execute(Validation $request)
    {
        try {
            $requestData = $request->validated();
            if (self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
