<?php

namespace App\Modules\ProductManagement\ProductUnit\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductUnit\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_unit_group_id" => $row['product_unit_group_id'],

                    "product_id" => $row['product_id'],

                    "title" => $row['title'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
