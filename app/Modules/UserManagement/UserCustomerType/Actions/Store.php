<?php

namespace App\Modules\UserManagement\UserCustomerType\Actions;

use App\Modules\UserManagement\UserCustomerType\Validations\Validation;


class Store
{
    static $model = \App\Modules\UserManagement\UserCustomerType\Models\Model::class;

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
