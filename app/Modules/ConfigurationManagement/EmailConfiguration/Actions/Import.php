<?php

namespace App\Modules\ConfigurationManagement\EmailConfiguration\Actions;

class Import
{
    static $model = \App\Modules\ConfigurationManagement\EmailConfiguration\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "type" => $row['type'],

                    "email" => $row['email'],

                    "user" => $row['user'],

                    "password" => $row['password'],

                    "host" => $row['host'],

                    "port" => $row['port'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}