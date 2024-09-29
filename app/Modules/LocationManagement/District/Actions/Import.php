<?php

namespace App\Modules\LocationManagement\District\Actions;

class Import
{
    static $model = \App\Modules\LocationManagement\District\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "country_id" => $row['country_id'],

                    "state_division_id" => $row['state_division_id'],

                    "name" => $row['name'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}