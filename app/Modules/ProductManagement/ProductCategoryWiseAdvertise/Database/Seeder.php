<?php

namespace App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 10; $i++) {
            self::$model::create([
                'product_category_id' => rand(1, 10),
                'title' => facker()->name,
                'is_promition' => rand(0, 1),
                'image' => facker()->imageUrl(1000, 400),
                'start_date' => Carbon::now()->toDateString(),
                'end_data' => Carbon::now()->addDays(10)->toDateString(),
            ]);
        }
    }
}
