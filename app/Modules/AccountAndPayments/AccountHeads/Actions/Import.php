<?php

namespace App\Modules\AccountAndPayments\AccountHeads\Actions;

class Import
{
    static $model = \App\Modules\AccountAndPayments\AccountHeads\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "description" => $row['description'],

                    "date" => $row['date'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}