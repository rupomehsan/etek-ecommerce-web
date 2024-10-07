<?php

namespace App\Modules\StockManagement\ProductStock\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\StockManagement\ProductStock\Database\Seeder"
     */
    static $model = \App\Modules\StockManagement\ProductStock\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        for ($i = 1; $i < 60; $i++) {
            self::$model::create([
                // 'date' => Carbon::now(),
                // 'stock_type' => 'initial',
                // 'product_id' => $i,
                // 'qty' => rand(1, 3),
                // 'bill_receipt_no' => rand(1000000, 9999999),
                // 'product_wearhouse_id' => 1,
            ]);
        }
    }
}
