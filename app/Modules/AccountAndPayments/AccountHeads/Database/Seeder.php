<?php
namespace App\Modules\AccountAndPayments\AccountHeads\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\AccountAndPayments\AccountHeads\Database\Seeder"
     */
    static $model = \App\Modules\AccountAndPayments\AccountHeads\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        self::$model::create([
            'title' => "Accounts Receivable",
            'description' => "Accounts Receivable",
            'date' => "1998-01-01",
            ]);
        self::$model::create([
            'title' => "Accounts Payable",
            'description' => "Accounts Receivable",
            'date' => "1998-01-02",
            ]);
        self::$model::create([
            'title' => "Cash",
            'description' => "Accounts Receivable",
            'date' => "1998-01-03",
            ]);
        self::$model::create([
            'title' => "Inventory",
            'description' => "Accounts Receivable",
            'date' => "1998-01-04",
            ]);
        self::$model::create([
            'title' => "Retained Earnings",
            'description' => "Accounts Receivable",
            'date' => "1998-01-05",
            ]);
    }
}
