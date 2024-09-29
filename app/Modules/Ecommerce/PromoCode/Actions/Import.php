<?php

namespace App\Modules\Ecommerce\PromoCode\Actions;

class Import
{
    static $model = \App\Modules\Ecommerce\PromoCode\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "code" => $row['code'],

                    "type" => $row['type'],

                    "value" => $row['value'],

                    "count" => $row['count'],

                    "expire_date" => $row['expire_date'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}