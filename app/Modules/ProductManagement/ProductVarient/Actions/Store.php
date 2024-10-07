<?php

namespace App\Modules\ProductManagement\ProductVarient\Actions;

class Store
{
    static $model = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['product_varient_group_id'] = json_decode(request()->product_varient_group_id)[0];
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
