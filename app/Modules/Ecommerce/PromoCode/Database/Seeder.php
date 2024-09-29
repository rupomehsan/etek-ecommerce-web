<?php

namespace App\Modules\Ecommerce\PromoCode\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Ecommerce\PromoCode\Database\Seeder"
     */
    static $model = \App\Modules\Ecommerce\PromoCode\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
            self::$model::create([
                'code' => "code" . rand(100, 1000),
                'type' => 'numeric',
                'value' => rand(100, 1000),
                'count' => rand(100, 1000),
                'expire_date' => facker()->date('Y-m-d'),
            ]);
        }
    }
}
