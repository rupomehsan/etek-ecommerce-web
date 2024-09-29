<?php

namespace App\Modules\StockManagement\ProductWearHouse\Actions;

class Import
{
    static $model = \App\Modules\StockManagement\ProductWearHouse\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "image" => $row['image'],

                    "product_wearhouse_branch_id" => $row['product_wearhouse_branch_id'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}