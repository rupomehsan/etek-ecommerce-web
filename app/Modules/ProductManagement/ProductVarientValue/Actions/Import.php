<?php

namespace App\Modules\ProductManagement\ProductVarientValue\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_varient_group_id" => $row['product_varient_group_id'],

                    "product_varient_id" => $row['product_varient_id'],

                    "title" => $row['title'],

                    "is_default" => $row['is_default'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
