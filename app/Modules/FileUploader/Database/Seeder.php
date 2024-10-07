<?php
namespace App\Modules\FileUploader\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\FileUploader\Database\Seeder"
     */
    static $model = \App\Modules\FileUploader\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
    }
}
