<?php

namespace App\Modules\StockManagement\ProductWearHouseBranch\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\StockManagement\ProductWearHouseBranch\Database\Seeder"
     */
    static $model = \App\Modules\StockManagement\ProductWearHouseBranch\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            'Gulshan',
            'IDB',
            'Barisal',
            'Chittagong',
            'Khulna',
            'Rajshahi',
            'Rangpur',
            'Sylhet',
            'Mymensingh',
        ];
        foreach ($data as $key => $value) {
            self::$model::create([
                'title' => $value,
            ]);
        }
    }
}
