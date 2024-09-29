<?php

namespace App\Modules\UserManagement\UserCustomerType\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\UserManagement\UserCustomerType\Database\Seeder"
     */
    static $model = \App\Modules\UserManagement\UserCustomerType\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 10; $i++) {
            self::$model::create([
                'title' => facker()->words(1, true),
            ]);
        }
    }
}
