<?php
namespace App\Modules\SalesManagement\SalesReturn\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\SalesManagement\SalesReturn\Database\Seeder"
     */
    static $model = \App\Modules\SalesManagement\SalesReturn\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'product_wearhouse_id' => facker()->name,
            'customer_id' => facker()->name,
            'product_id' => facker()->name,
            'date' => facker()->name,
            'order_id' => facker()->name,
            'discount_on_all' => facker()->name,
            'discount_on_all_type' => facker()->name,
            'is_quotation' => facker()->name,
            'is_order' => facker()->name,
            'is_invoiced' => facker()->name,
            'is_delivered' => facker()->name,
            'is_paid' => facker()->name,
            'order_type' => facker()->name,
            'order_status' => facker()->name,
            'total' => facker()->name,
            'subtotal' => facker()->name,
            'paid_amount' => facker()->name,
            'source' => facker()->name,
            ]);
        }
    }
}
