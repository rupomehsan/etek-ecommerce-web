<?php

namespace App\Modules\ProductManagement\ProductVarient\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
      php artisan db:seed --class="\App\Modules\ProductManagement\ProductVarient\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;

    public function run(): void
    {
        self::$model::truncate();

        $variants = [
            ['size', 1, 'text'],
            ['material', 1, 'text'],
            ['pattern', 1, 'text'],
            ['brand', 2, 'text'],
            ['color', 2, 'color'],
            ['storage', 2, 'text'],
            ['screen_size', 2, 'text'],
            ['battery', 2, 'text'],
            ['resolution', 2, 'text'],
            ['os', 2, 'text'],
        ];

        foreach ($variants as [$title, $groupId, $type]) {
            self::$model::create([
                'product_varient_group_id' => $groupId,
                'title' => $title,
                'varient_type' => $type,
                'is_required' => rand(0, 1),
            ]);
        }
    }
}
