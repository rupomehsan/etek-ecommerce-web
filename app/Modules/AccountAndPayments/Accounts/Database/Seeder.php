<?php
namespace App\Modules\AccountAndPayments\Accounts\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\AccountAndPayments\Accounts\Database\Seeder"
     */
    static $model = \App\Modules\AccountAndPayments\Accounts\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        self::$model::create([
            'account_head_id' => '1',
            'title' => 'test1',
            'description' => "Lorem ipsum dolor sit amet.",
            'transaction_start_date' => '2021-09-01',
            'account_transaction_type' => 'income',
            ]);
        self::$model::create([
            'account_head_id' => '2',
            'title' => 'test2',
            'description' => "Lorem ipsum dolor sit amet.",
            'transaction_start_date' => '2021-09-02',
            'account_transaction_type' => 'expense',
            ]);
        self::$model::create([
            'account_head_id' => '3',
            'title' => 'test3',
            'description' => "Lorem ipsum dolor sit amet.",
            'transaction_start_date' => '2021-09-03',
            'account_transaction_type' => 'income',
            ]);
        self::$model::create([
            'account_head_id' => '4',
            'title' => 'test4',
            'description' => "Lorem ipsum dolor sit amet.",
            'transaction_start_date' => '2021-09-04',
            'account_transaction_type' => 'expense',
            ]);
        self::$model::create([
            'account_head_id' => '5',
            'title' => 'test5',
            'description' => "Lorem ipsum dolor sit amet.",
            'transaction_start_date' => '2021-09-05',
            'account_transaction_type' => 'income',
            ]);
    }
}
