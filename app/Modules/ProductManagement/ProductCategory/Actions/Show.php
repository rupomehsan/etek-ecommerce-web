<?php

namespace App\Modules\ProductManagement\ProductCategory\Actions;



class Show
{
    static $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($slug)
    {
        try {
            $with = [
                'parent:id,title',
                'group:id,title',
            ];
            $fields = request()->input('fields') ?? [];
            if (empty($fields)) {
                $fields = ['*'];
            }
            $data = self::$model::query()
                ->with($with)
                ->select($fields)
                ->where('slug', $slug)
                ->first();
            if (!$data) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $data->total_products = $data->products()->count();
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
