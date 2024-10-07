<?php

namespace App\Modules\BannerManagement\HomeBanner\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\BannerManagement\HomeBanner\Database\Seeder"
     */
    static $model = \App\Modules\BannerManagement\HomeBanner\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        for ($i = 1; $i <= 2; $i++) {
            self::$model::create([
                'title' => facker()->name,
                'short_des' => facker()->name,
                'offer_title' => facker()->name,
                'button_url' => facker()->name,
                'image' => "frontend/assets/images/banner_$i.png",
                'is_show' => 1,
            ]);
        }

        self::$model::create([
            'title' => facker()->name,
            'short_des' => facker()->name,
            'offer_title' => facker()->name,
            'button_url' => facker()->name,
            'image' => "frontend/assets/images/banners/13.png",
            'is_show' => 1,
        ]);

    }
}

