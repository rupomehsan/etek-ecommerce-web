<?php

namespace App\Modules\ProductManagement\Product\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "type" => $row['type'],

                    "short_description" => $row['short_description'],

                    "description" => $row['description'],

                    "product_menufecturer_id" => $row['product_menufecturer_id'],

                    "product_brand_id" => $row['product_brand_id'],

                    "sku" => $row['sku'],

                    "product_unit_id" => $row['product_unit_id'],

                    "alert_quantity" => $row['alert_quantity'],

                    "seller_points" => $row['seller_points'],

                    "is_returnable" => $row['is_returnable'],

                    "expiration_days" => $row['expiration_days'],

                    "purchase_price" => $row['purchase_price'],

                    // "purchase_account" => $row['purchase_account'],

                    "discount_type" => $row['discount_type'],

                    "discount_amount" => $row['discount_amount'],

                    // "tax_id" => $row['tax_id'],

                    "tax_type" => $row['tax_type'],

                    // "vat_on_sale" => $row['vat_on_sale'],

                    // "vat_on_purchase" => $row['vat_on_purchase'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
