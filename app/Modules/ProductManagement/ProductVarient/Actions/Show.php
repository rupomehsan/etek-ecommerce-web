<?php

namespace App\Modules\ProductManagement\ProductVarient\Actions;



class Show
{
    static $model = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;

    public static function execute($slug)
    {
        try {
            $with = ['product_varient_group'];
            $fields = request()->input('fields') ?? [];
            if (empty($fields)) {
                $fields = ['*'];
            }
            if (!$data = self::$model::query()->with($with)->select($fields)->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
