<?php

namespace App\Modules\ProductManagement\ProductBarCode\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductBarCode\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductBarCode\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
            self::$model::create([
                'product_id' => rand(1, 20),
                'barcode_image' => facker()->imageUrl(100, 100),
                'price' => rand(1000, 10000),
                'title' => facker()->title(),
                'company_name' => facker()->name,
            ]);
        }
    }
}
