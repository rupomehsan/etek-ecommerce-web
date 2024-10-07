<?php

namespace App\Modules\SalesManagement\SalesEcommerceOrder\Actions;

class Import
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                self::$model::create([
                    'order_id' => $row['order_id'],
                    'date' => $row['date'],
                    'user_type' => $row['user_type'],
                    'user_id' => $row['user_id'],
                    'is_delivered' => $row['is_delivered'],
                    'order_status' => $row['order_status'],
                    'user_address_id' => $row['user_address_id'],
                    'delivery_method' => $row['delivery_method'],
                    'delivery_address_id' => $row['delivery_address_id'],
                    'subtotal' => $row['subtotal'],
                    'delivery_charge' => $row['delivery_charge'],
                    'additional_charge' => $row['additional_charge'],
                    'product_coupon_id' => $row['product_coupon_id'],
                    'coupon_discount' => $row['coupon_discount'],
                    'discount' => $row['discount'],
                    'discount_type' => $row['discount_type'],
                    'total' => $row['total'],
                    'is_paid' => $row['is_paid'],
                    'paid_amount' => $row['paid_amount'],
                    'paid_status' => $row['paid_status'],
                    'payment_id' => $row['payment_id'],
                    'payment_method' => $row['payment_method'],
                    'product_wearhouse_id' => $row['product_wearhouse_id'],


                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
