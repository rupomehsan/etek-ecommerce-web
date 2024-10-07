<?php

namespace App\Modules\ProductManagement\ProductRegion\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductRegion\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_id" => $row['product_id'],

                    "country_id" => $row['country_id'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}