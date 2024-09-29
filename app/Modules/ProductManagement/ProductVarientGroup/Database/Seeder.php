<?php

namespace App\Modules\ProductManagement\ProductVarientGroup\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductVarientGroup\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductVarientGroup\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            "apparel",
            "electronics",
            "kitchen",
            "grocery",
        ];

        foreach ($data as $item) {
            self::$model::create([
                'title' => $item,
            ]);
        }
    }
}
