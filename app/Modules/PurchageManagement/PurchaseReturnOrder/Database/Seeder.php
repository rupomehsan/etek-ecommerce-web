<?php
namespace App\Modules\PurchageManagement\PurchaseReturnOrder\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\PurchageManagement\PurchaseReturnOrder\Database\Seeder"
     */
    static $model = \App\Modules\PurchageManagement\PurchaseReturnOrder\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        for ($i = 1; $i < 100; $i++) {
        self::$model::create([
            'product_wearhouse_id' => facker()->name,
            'supplier_id' => facker()->name,
            'product_id' => facker()->name,
            'date' => facker()->name,
            'reference' => facker()->name,
            'discount_on_all' => facker()->name,
            'discount_on_all_type' => facker()->name,
            'subtotal' => facker()->name,
            'total' => facker()->name,
            ]);
        }
    }
}