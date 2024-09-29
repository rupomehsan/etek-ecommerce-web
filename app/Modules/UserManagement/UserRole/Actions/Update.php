<?php

namespace App\Modules\UserManagement\UserRole\Actions;

use App\Modules\UserManagement\UserRole\Validations\Validation;

class Update
{
    static $model = \App\Modules\UserManagement\UserRole\Models\Model::class;

    public static function execute(Validation $request,$id)
    {
        try {
            if (!$data = self::$model::query()->where('id', $id)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            $data->update($requestData);
            return messageResponse('Item updated successfully');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
