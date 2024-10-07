<?php
namespace App\Modules\ConfigurationManagement\EmailConfiguration\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ConfigurationManagement\EmailConfiguration\Database\Seeder"
     */
    static $model = \App\Modules\ConfigurationManagement\EmailConfiguration\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'type' => facker()->name,
            'email' => facker()->name,
            'user' => facker()->name,
            'password' => facker()->name,
            'host' => facker()->name,
            'port' => facker()->name,
            ]);
        }
    }
}