<?php

namespace App\Modules\LocationManagement\Country\Actions;

class Import
{
    static $model = \App\Modules\LocationManagement\Country\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "name" => $row['name'],

                    "country_code" => $row['country_code'],

                    "country_short_code" => $row['country_short_code'],

                    "flag_url" => $row['flag_url'],

                ]);
            }
            return messageResponse('Items imported successfully', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
