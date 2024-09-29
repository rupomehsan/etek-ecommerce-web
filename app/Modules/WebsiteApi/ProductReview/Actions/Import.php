<?php

namespace App\Modules\WebsiteApi\ProductReview\Actions;

class Import
{
    static $model = \App\Modules\WebsiteApi\ProductReview\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "user_id" => $row['user_id'],

                    "product_id" => $row['product_id'],

                    "rating" => $row['rating'],

                    "description" => $row['description'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}