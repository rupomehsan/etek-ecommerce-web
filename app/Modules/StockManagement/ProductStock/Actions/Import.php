<?php

namespace App\Modules\StockManagement\ProductStock\Actions;

class Import
{
    static $model = \App\Modules\StockManagement\ProductStock\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "date" => $row['date'],

                    "stock_type" => $row['stock_type'],

                    "product_id" => $row['product_id'],

                    "qty" => $row['qty'],

                    "bill_receipt_no" => $row['bill_receipt_no'],

                    "purchase_order_id" => $row['purchase_order_id'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}