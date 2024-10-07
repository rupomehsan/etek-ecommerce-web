<?php

namespace App\Modules\PurchageManagement\PurchaseOrder\Actions;

class Import
{
    static $model = \App\Modules\PurchageManagement\PurchaseOrder\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_wearhouse_id" => $row['product_wearhouse_id'],

                    "supplier_id" => $row['supplier_id'],

                    "date" => $row['date'],

                    "reference" => $row['reference'],

                    "discount_on_all" => $row['discount_on_all'],

                    "discount_on_all_type" => $row['discount_on_all_type'],

                    "subtotal" => $row['subtotal'],

                    "total" => $row['total'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
