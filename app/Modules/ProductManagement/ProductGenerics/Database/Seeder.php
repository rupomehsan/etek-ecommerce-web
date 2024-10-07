<?php
namespace App\Modules\ProductManagement\ProductGenerics\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductGenerics\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductGenerics\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'title' => facker()->name,
            ]);
        }
    }
}