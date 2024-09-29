<?php

namespace App\Modules\BannerManagement\HomeSideBanner\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\BannerManagement\HomeSideBanner\Database\Seeder"
     */
    static $model = \App\Modules\BannerManagement\HomeSideBanner\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        self::$model::create([
            'banner_one' => "frontend/assets/images/banners/10.png",
            'banner_two' => "frontend/assets/images/banners/6.png",
            'banner_three' => "frontend/assets/images/banners/9.png",
            'banner_four' => "frontend/assets/images/banners/12.png",
        ]);
    }
}
