<?php

namespace App\Modules\ProductManagement\ProductUnitGroup\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductUnitGroup\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductUnitGroup\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            "Electronics",
            "Food and Beverage",
            "Clothing and Apparel",
            "Pharmaceuticals",
            "Furniture",
        ];
        foreach ($data as $key => $value) {
            self::$model::create([
                'title' => $value,
            ]);
        }
    }
}
