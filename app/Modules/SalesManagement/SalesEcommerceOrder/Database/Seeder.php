<?php

namespace App\Modules\SalesManagement\SalesEcommerceOrder\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\SalesManagement\SalesEcommerceOrder\Database\Seeder"
     */
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;
    static $SalesOrderChargeModel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderChargeModel::class;
    static $SalesOrderProductModel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderProductModel::class;
    static $SalesOrderPaymentModel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderPaymentModel::class;
    /**
     * stock management model
     */
    static $producStockModel = \App\Modules\StockManagement\ProductStock\Models\Model::class;
    /**
     *  run
     */
    public function run(): void
    {

        self::$model::truncate();
        $productId = 1;
        for ($i = 1; $i < 5; $i++) {

            $subTotal = 0;
            $order =  self::$model::create([
                'order_id' => "ETEK" . rand(1000000, 999999999),
                'date' => Carbon::now()->toDateString(),
                'user_type' => "ecommerce",
                'user_id' => 3,
                'is_delivered' => 0,
                'order_status' => ['pending', 'accepted'][rand(0, 1)],
                'user_address_id' => 5,
                'delivery_method' => 'home_delivery',
                'delivery_address_id' => 6,
                'delivery_charge' => 50,
                'additional_charge' => 0,
                'product_coupon_id' => null,
                'coupon_discount' => null,
                'subtotal' => $subTotal,
                'total' => 0,
                'is_paid' => 0,
                'payment_id' => null,
                'payment_method' => "cod",
            ]);

            for ($j = $productId; $j < $productId + 3; $j++) {

                $price = [500, 700, 1000][rand(0, 2)];

                $SalesOrderProduct = self::$SalesOrderProductModel::create([
                    "sales_ecommerce_order_id" => $order->id,
                    "product_id" => $j,
                    "product_price" => $price,
                    "discount" => 50,
                    "price" => $price - 50,
                    "qty" => 3,
                    "discount_type" => "fixed",
                    "subtotal" => $price * 3,
                    "total" => ($price * 3) - 50,
                ]);



                $salesOrderCharge = self::$SalesOrderChargeModel::create([
                    "sales_order_id" => $order->id,
                    "sales_order_product_id" => $SalesOrderProduct->id,
                    "vat_id" => 1,
                    "vat_group_id" => null,
                    "amount" => $price * 2 / 100,
                ]);

                $SalesOrderProduct->total += $salesOrderCharge->amount;
                $SalesOrderProduct->save();
                $subTotal +=  $SalesOrderProduct->total;

                $stockLogData = [
                    "product_wearhouse_id" => 1,
                    "purchase_order_id" => $SalesOrderProduct->id,
                    "date" => $order->date,
                    "stock_type" => 'purchase',
                    "product_id" => $j,
                    "qty" => $SalesOrderProduct->qty,
                    "purchase_return_id" => null,
                    "sales_order_id" => null,
                    "sales_return_id" => null,
                    "product_waste_id" => null,
                ];

                if ($order->order_status == 'accepted') {
                    stockLogStore($stockLogData);
                }

            }

            $order->subtotal = $subTotal;
            $order->total = $subTotal - $order->discount_on_all;
            $order->save();

            $productId += 3;
        }
    }
}
