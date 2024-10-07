<?php

namespace App\Modules\ProductManagement\ProductVarientValue\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
      php artisan db:seed --class="\App\Modules\ProductManagement\ProductVarientValue\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;

    public function run(): void
    {
        self::$model::truncate();

        $variantGroups = [
            1 => ['xs', 'sm', 'md', 'lg', 'xl', 'xxl', 'xxxl', '4xl', '5xl', '6xl'],
            2 => [
                2 => ['cotton', 'polyester', 'wool', 'silk', 'linen'],
                3 => ['solid', 'striped', 'checked', 'printed', 'dotted'],
                4 => ['brandA', 'brandB', 'brandC', 'brandD', 'brandE'],
                5 => ['black', 'white', 'silver', 'gold', 'blue', 'red', 'green', 'purple', 'gray', 'pink'],
                6 => ['64GB', '128GB', '256GB', '512GB', '1TB', '2TB'],
                7 => ['5.5"', '6.1"', '6.5"', '6.7"', '7"', '7.5"', '8"', '10"', '12"', '13.3"', '15.6"', '17.3"'],
                8 => ['3000mAh', '4000mAh', '4500mAh', '5000mAh', '6000mAh'],
                9 => ['720p', '1080p', '1440p', '4K', '8K'],
                10 => ['Android', 'iOS', 'Windows', 'MacOS', 'Linux'],
            ]
        ];

        foreach ($variantGroups as $groupId => $variants) {
            if (array_values($variants) !== $variants) {  // check if associative array
                foreach ($variants as $variantId => $titles) {
                    foreach ($titles as $title) {
                        $value = "#" . rand(100000, 999999);
                        self::$model::create([
                            'product_varient_group_id' => $groupId,
                            'product_varient_id' => $variantId,
                            'title' => $title,
                            "value" => $variantId == 5 ? $value : NULL
                        ]);
                    }
                }
            } else {
                foreach ($variants as $title) {
                    self::$model::create([
                        'product_varient_group_id' => $groupId,
                        'product_varient_id' => 1,
                        'title' => $title,
                    ]);
                }
            }
        }
    }
}
