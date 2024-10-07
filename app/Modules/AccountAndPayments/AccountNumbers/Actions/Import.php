<?php

namespace App\Modules\AccountAndPayments\AccountNumbers\Actions;

class Import
{
    static $model = \App\Modules\AccountAndPayments\AccountNumbers\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "account_head_id" => $row['account_head_id'],

                    "account_id" => $row['account_id'],

                    "account_number" => $row['account_number'],

                    "account_name" => $row['account_name'],

                    "amount" => $row['amount'],

                    "opening_balance" => $row['opening_balance'],

                    "account_transaction_id" => $row['account_transaction_id'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}