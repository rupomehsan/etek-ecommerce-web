<?php

namespace App\Modules\LocationManagement\Country\Actions;

class Store
{
    static $model = \App\Modules\LocationManagement\Country\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['country_symbol'] = json_encode($requestData['country_symbol']);
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
