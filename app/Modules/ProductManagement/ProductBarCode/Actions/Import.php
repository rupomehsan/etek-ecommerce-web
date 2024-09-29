<?php

namespace App\Modules\ProductManagement\ProductBarCode\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductBarCode\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_id" => $row['product_id'],

                    "barcode_image" => $row['barcode_image'],

                    "price" => $row['price'],

                    "title" => $row['title'],

                    "company_name" => $row['company_name'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
