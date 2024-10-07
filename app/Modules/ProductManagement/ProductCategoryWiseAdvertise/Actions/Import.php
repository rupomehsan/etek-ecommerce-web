<?php

namespace App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "category_id" => $row['category_id'],

                    "title" => $row['title'],

                    "is_promition" => $row['is_promition'],

                    "image" => $row['image'],

                    "start_date" => $row['start_date'],

                    "end_data" => $row['end_data'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}