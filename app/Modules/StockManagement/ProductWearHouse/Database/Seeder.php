<?php

namespace App\Modules\StockManagement\ProductWearHouse\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\StockManagement\ProductWearHouse\Database\Seeder"
     */
    static $model = \App\Modules\StockManagement\ProductWearHouse\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            [
                "title" => 'Gulshan Grocery',
                "image" => 'backend/assets/images/warehouse/warehouse.jpg',
                'product_wearhouse_branch_id' => 1
            ],
        ];
        foreach ($data as $key => $value) {
            self::$model::create([
                'title' => $value['title'],
                'image' => $value['image'],
                'product_wearhouse_branch_id' => $value['product_wearhouse_branch_id'],
            ]);
        }
    }
}
