<?php

namespace App\Modules\SalesManagement\SalesReturn\Actions;

class Import
{
    static $model = \App\Modules\SalesManagement\SalesReturn\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_wearhouse_id" => $row['product_wearhouse_id'],

                    "customer_id" => $row['customer_id'],

                    "product_id" => $row['product_id'],

                    "date" => $row['date'],

                    "order_id" => $row['order_id'],

                    "discount_on_all" => $row['discount_on_all'],

                    "discount_on_all_type" => $row['discount_on_all_type'],

                    "is_quotation" => $row['is_quotation'],

                    "is_order" => $row['is_order'],

                    "is_invoiced" => $row['is_invoiced'],

                    "is_delivered" => $row['is_delivered'],

                    "is_paid" => $row['is_paid'],

                    "order_type" => $row['order_type'],

                    "order_status" => $row['order_status'],

                    "total" => $row['total'],

                    "subtotal" => $row['subtotal'],

                    "paid_amount" => $row['paid_amount'],

                    "source" => $row['source'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
