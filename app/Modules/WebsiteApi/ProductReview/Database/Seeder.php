<?php
namespace App\Modules\WebsiteApi\ProductReview\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\WebsiteApi\ProductReview\Database\Seeder"
     */
    static $model = \App\Modules\WebsiteApi\ProductReview\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'user_id' => facker()->name,
            'product_id' => facker()->name,
            'rating' => facker()->name,
            'description' => facker()->name,
            ]);
        }
    }
}