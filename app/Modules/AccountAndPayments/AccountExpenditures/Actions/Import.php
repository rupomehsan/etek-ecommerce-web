<?php

namespace App\Modules\AccountAndPayments\AccountExpenditures\Actions;

class Import
{
    static $model = \App\Modules\AccountAndPayments\AccountExpenditures\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "account_expenditure_group_id" => $row['account_expenditure_group_id'],

                    "title" => $row['title'],

                    "description" => $row['description'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}