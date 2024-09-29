<?php
namespace App\Modules\AccountAndPayments\AccountExpenditures\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\AccountAndPayments\AccountExpenditures\Database\Seeder"
     */
    static $model = \App\Modules\AccountAndPayments\AccountExpenditures\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        self::$model::create([
            'account_expenditure_group_id' => 1,
            'title' => 'Gas Bill',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, placeat.'
            ]);

        self::$model::create([
            'account_expenditure_group_id' => 2,
            'title' => 'Electricity Bill',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, placeat.'
            ]);

        self::$model::create([
            'account_expenditure_group_id' => 3,
            'title' => 'Home Rent',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, placeat.'
            ]);

        self::$model::create([
            'account_expenditure_group_id' => 2,
            'title' => 'Water Bill',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, placeat.'
            ]);
        }
}
