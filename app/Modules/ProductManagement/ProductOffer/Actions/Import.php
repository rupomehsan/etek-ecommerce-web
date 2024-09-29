<?php

namespace App\Modules\ProductManagement\ProductOffer\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
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