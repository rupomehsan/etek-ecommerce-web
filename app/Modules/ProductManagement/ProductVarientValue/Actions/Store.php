<?php

namespace App\Modules\ProductManagement\ProductVarientValue\Actions;
use \App\Modules\ProductManagement\ProductVarient\Models\Model as ProductVarient;

class Store
{
    static $model = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['product_varient_group_id'] = null;
            $requestData['product_varient_id'] = json_decode(request()->product_varient_id)[0];
            $v = ProductVarient::where('id',$requestData['product_varient_id'])->first();
            if($v){
                $requestData['product_varient_group_id'] = $v->product_varient_group_id;
            }
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
