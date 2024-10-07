<?php

namespace App\Modules\ProductManagement\ProductMenufacturer\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductMenufacturer\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductMenufacturer\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            [
                "title" => "Asus",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/asus-100x100.jpg"
            ],
            [
                "title" => "Lenovo",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/lenovo-100x100.jpg"
            ],
            [
                "title" => "Brother",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/brother-color-1-100x100.png"
            ],
            [
                "title" => "LG",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/lg-color-1-100x100.png"
            ],
        ];

        foreach ($data as $key => $item) {
            self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'image' => $item['image'],
            ]);
        }
    }
}
