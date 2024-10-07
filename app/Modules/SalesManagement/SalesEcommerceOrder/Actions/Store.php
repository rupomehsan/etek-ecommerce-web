<?php

namespace App\Modules\SalesManagement\SalesEcommerceOrder\Actions;

class Store
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;

    public static function execute($request)
    {
        try {
            dd($request->all());
            $requestData = $request->validated();
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
