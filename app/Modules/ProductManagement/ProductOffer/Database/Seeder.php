<?php

namespace App\Modules\ProductManagement\ProductOffer\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductOffer\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [

            [
                'title' => 'Summer collection',
                'description' => 'description',
                'discount_type' => 'percentage',
                'discount' =>   10,
                'image' => '/frontend/assets/images/summer_collection.webp',
            ],

            [
                'title' => 'Popular products',
                'description' => 'description',
                'discount_type' => 'percentage',
                'discount' =>   10,
                'image' => '/frontend/assets/images/popular_products.webp',
            ],

            [
                'title' => 'Flash sale',
                'description' => 'description',
                'discount_type' => 'percentage',
                'discount' =>   10,
                'image' => '/frontend/assets/images/flash_sale.webp',
            ],

            [
                'title' => 'Super saver',
                'description' => 'description',
                'discount_type' => 'percentage',
                'discount' =>   10,
                'image' => '/frontend/assets/images/super_saver.webp',
            ],
            
        ];
        foreach ($data as  $value) {
            self::$model::create($value);
        }
    }
}
