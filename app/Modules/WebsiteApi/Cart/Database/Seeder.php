<?php
namespace App\Modules\WebsiteApi\Cart\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\WebsiteApi\Cart\Database\Seeder"
     */
    static $model = \App\Modules\WebsiteApi\Cart\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'user_id' => facker()->name,
            'product_id' => facker()->name,
            ]);
        }
    }
}