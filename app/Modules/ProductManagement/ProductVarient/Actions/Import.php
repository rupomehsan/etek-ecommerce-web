<?php

namespace App\Modules\ProductManagement\ProductVarient\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_varient_group_id" => $row['product_varient_group_id'],

                    "title" => $row['title'],

                    "is_required" => $row['is_required'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
