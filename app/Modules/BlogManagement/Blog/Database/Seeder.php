<?php

namespace App\Modules\BlogManagement\Blog\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\BlogManagement\Blog\Database\Seeder"
     */
    static $model = \App\Modules\BlogManagement\Blog\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 10; $i++) {
            self::$model::create([
                'title' => facker()->name,
                'description' => facker()->text(),
                'tags' => facker()->name,
                'publish_date' => facker()->date(),
                'writer' => facker()->name,
                'meta_title' => facker()->name,
                'meta_description' => facker()->name,
                'meta_keywords' => facker()->name,
                'thumbnail_image' => facker()->imageUrl(250, 300),
                'image' => [facker()->imageUrl(250, 300), facker()->imageUrl(250, 300), facker()->imageUrl(250, 300)],
                'video_url' => facker()->url(),
            ]);
        }
    }
}
