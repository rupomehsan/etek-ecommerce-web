<?php
namespace App\Modules\AccountAndPayments\AccountNumbers\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\AccountAndPayments\AccountNumbers\Database\Seeder"
     */
    static $model = \App\Modules\AccountAndPayments\AccountNumbers\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        self::$model::create([
            'account_head_id' => '1',
            'account_id' => '1',
            'account_number' => '1',
            'account_name' => 'test1',
            'amount' => '100',
            'opening_balance' => '11',
            'account_transaction_id' => '111',
            ]);
        self::$model::create([
            'account_head_id' => '2',
            'account_id' => '2',
            'account_number' => '2',
            'account_name' => 'test2',
            'amount' => '200',
            'opening_balance' => '2',
            'account_transaction_id' => '211',
            ]);
    }
}
