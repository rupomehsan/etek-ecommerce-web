<?php

namespace App\Modules\VatManagement\VatGroup\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\VatManagement\VatGroup\Database\Seeder"
     */
    static $model = \App\Modules\VatManagement\VatGroup\Models\Model::class;
    public function run(): void
    {
        self::$model::truncate();
        $data = [
            [
                "title" => "Import VAT",
            ],
        ];
        foreach ($data as $key => $value) {
            $vatGroup =  self::$model::create([
                'title' => $value['title'],
            ]);

            $vatGroup->vat_group_vats()->attach([1, 3]);
        }
    }
}
