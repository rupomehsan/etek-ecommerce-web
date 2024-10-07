<?php

namespace App\Modules\ProductManagement\ProductCategoryGroup\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductCategoryGroup\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductCategoryGroup\Models\Model::class;
    public function run(): void
    {
        self::$model::truncate();
        $groupData = [
            [
                "title" => "খাদ্য ও মুদি সামগ্রী",
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1637.jpg",
            ],
            [
                "title" => "চাল ও খাদ্যশস্য",
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2154.jpg",
            ],
            [
                "title" => "ইলেক্ট্রনিক্স ও যন্ত্রপাতি",
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2178.jpg",
            ],
            [
                "title" => "কম্পিউটার ও আইটি",
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat16.jpg",
            ],

        ];

        foreach ($groupData as $item) {
            self::$model::create([
                'title' => $item['title'],
                'image' => $item['image'],
            ]);
        }


        
    }
}
