<?php

namespace App\Modules\ConfigurationManagement\SMSConfiguration\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ConfigurationManagement\SMSConfiguration\Database\Seeder"
     */
    static $model = \App\Modules\ConfigurationManagement\SMSConfiguration\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        self::$model::create([
            'sms_provider' => 'URCL',
            'sms_gateway_url' => 'http://45.120.38.242/api/sendsms?',
            'port' => null,
            'api_key' => '01319193270.VXMttpitkxGPG7XtpitwoldS2a',
            'secret_key' => null,
            'callder_id' => null,
            'user_name' => null,
            'password' => null,
            'is_active' => 1,
        ]);
    }
}

