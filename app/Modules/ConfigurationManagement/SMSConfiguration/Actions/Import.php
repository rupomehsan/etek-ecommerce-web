<?php

namespace App\Modules\ConfigurationManagement\SMSConfiguration\Actions;

class Import
{
    static $model = \App\Modules\ConfigurationManagement\SMSConfiguration\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "sms_provider" => $row['sms_provider'],

                    "sms_gateway_url" => $row['sms_gateway_url'],

                    "port" => $row['port'],

                    "api_key" => $row['api_key'],

                    "secret_key" => $row['secret_key'],

                    "callder_id" => $row['callder_id'],

                    "user_name" => $row['user_name'],

                    "password" => $row['password'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}