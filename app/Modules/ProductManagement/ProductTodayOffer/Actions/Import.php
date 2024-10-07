<?php

namespace App\Modules\ProductManagement\ProductTodayOffer\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductTodayOffer\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_id" => $row['product_id'],

                    "title" => $row['title'],

                    "description" => $row['description'],

                    "discount_type" => $row['discount_type'],

                    "discount" => $row['discount'],

                    "image" => $row['image'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}