<?php

namespace App\Modules\ConfigurationManagement\WebsiteConfiguration\Actions;

class Import
{
    static $model = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
