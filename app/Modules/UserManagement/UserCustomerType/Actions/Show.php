<?php

namespace App\Modules\UserManagement\UserCustomerType\Actions;



class Show
{
    static $model = \App\Modules\UserManagement\UserCustomerType\Models\Model::class;

    public static function execute($id)
    {
        try {
            $with = [];
            if (!$data = self::$model::query()->with($with)->where('id', $id)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
