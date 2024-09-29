<?php
namespace App\Modules\AccountAndPayments\AccountExpenditureGroups\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\AccountAndPayments\AccountExpenditureGroups\Database\Seeder"
     */
    static $model = \App\Modules\AccountAndPayments\AccountExpenditureGroups\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        self::$model::create([
            'title' => 'Cost of Goods Sold (COGS)',
            'description' => "Lorem ipsum dolor sit ame",
            ]);
        self::$model::create([
            'title' => "Operating Expenses",
            'description' => "Lorem ipsum dolor sit ame",
            ]);
        self::$model::create([
            'title' => "Capital Expenditures (CapEx)",
            'description' => "Lorem ipsum dolor sit ame",
            ]);
        self::$model::create([
            'title' => "Administrative Expenses",
            'description' => "Lorem ipsum dolor sit ame",
            ]);
        self::$model::create([
            'title' => "Administrative Expenses",
            'description' => "Lorem ipsum dolor sit ame",
            ]);
    }
}
