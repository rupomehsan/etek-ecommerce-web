<?php

namespace App\Modules\AccountAndPayments\Accounts\Actions;

class Import
{
    static $model = \App\Modules\AccountAndPayments\Accounts\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "account_head_id" => $row['account_head_id'],

                    "title" => $row['title'],

                    "description" => $row['description'],

                    "transaction_start_date" => $row['transaction_start_date'],

                    "account_transaction_type" => $row['account_transaction_type'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}