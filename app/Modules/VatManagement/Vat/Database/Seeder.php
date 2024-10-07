<?php

namespace App\Modules\VatManagement\Vat\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\VatManagement\Vat\Database\Seeder"
     */
    static $model = \App\Modules\VatManagement\Vat\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            [
                'title' => 'Standard ',
                'percentage' => '2',
            ],
            [
                'title' => 'LC',
                'percentage' => '1',
            ],
            [
                'title' => 'Machinaries',
                'percentage' => '30',
            ]
        ];

        foreach ($data as $item) {
            self::$model::create([
                'title' => $item['title'],
                'percentage' => $item['percentage'],
            ]);
        }
    }
}
