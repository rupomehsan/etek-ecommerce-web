<?php

namespace App\Modules\LocationManagement\StateDivision\Actions;

class Import
{
    static $model = \App\Modules\LocationManagement\StateDivision\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "country_id" => $row['country_id'],

                    "name" => $row['name'],

                ]);
            }
            return messageResponse('Items imported successfully', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
