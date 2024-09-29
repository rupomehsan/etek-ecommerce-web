<?php

namespace App\Modules\ProductManagement\ProductVarient\Actions;

class Update
{
    static $model = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            $requestData['product_varient_group_id'] = json_decode(request()->product_varient_group_id)[0];
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
