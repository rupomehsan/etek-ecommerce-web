<?php

namespace App\Modules\ProductManagement\ProductUnit\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductUnit\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductUnit\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            "Pieces",
            "Box",
            "Set",
            "Gross",
        ];
        foreach ($data as $item) {
            self::$model::create([
                'product_unit_group_id' => 1,
                'product_id' => rand(1, 10),
                'title' => $item,
            ]);
        }

        $data = [
            "Kilogram",
            "Liter",
            "Pack",
            "Carton",
            "Bottle",
        ];
        foreach ($data as $item) {
            self::$model::create([
                'product_unit_group_id' => 2,
                'product_id' => rand(20, 30),
                'title' => $item,
            ]);
        }
        $data = [
            "Tablet",
            "Bottle",
            "Box",
            "Strip",
        ];
        foreach ($data as $item) {
            self::$model::create([
                'product_unit_group_id' => 3,
                'product_id' => rand(40, 50),
                'title' => $item,
            ]);
        }
        $data = [
            "Piece",
            "Set",
            "Box",
        ];
        foreach ($data as $item) {
            self::$model::create([
                'product_unit_group_id' => 4,
                'product_id' => rand(60, 70),
                'title' => $item,
            ]);
        }
    }
}
