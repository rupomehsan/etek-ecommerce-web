<?php
namespace App\Modules\Ecommerce\GeneralSeo\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Ecommerce\GeneralSeo\Database\Seeder"
     */
    static $model = \App\Modules\Ecommerce\GeneralSeo\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'title' => facker()->name,
            'value' => facker()->name,
            ]);
        }
    }
}