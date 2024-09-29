<?php
namespace App\Modules\UserManagement\UserRole\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\UserManagement\UserRole\Database\Seeder"
     */
    static $model = \App\Modules\UserManagement\UserRole\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $roles = [
            "super_admin",
            "admin",
            "customer",
            "sales",
            "accountant",
            "retailer",
            "supplier",
            "delivery_man",
            "employee",
        ];
        foreach ($roles as $index => $role) {
            self::$model::create([
                'name' => $role,
                'serial' => $index + 1,
            ]);
        }
    }
}
