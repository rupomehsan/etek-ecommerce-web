<?php

namespace App\Modules\WebsiteApi\ProductQuestion\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\WebsiteApi\ProductQuestion\Database\Seeder"
     */
    static $model = \App\Modules\WebsiteApi\ProductQuestion\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
            self::$model::create([
                'user_id' => 3,
                'product_id' => rand(1, 60),
                'question' => facker()->text(),
                'answare' => facker()->text(),
            ]);
        }
    }
}
