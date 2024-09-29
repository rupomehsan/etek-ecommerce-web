<?php

namespace App\Modules\WebsiteApi\WebsiteSettings\Actions;

class GetWebsiteSettings
{
    static $model = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;

    public static function execute()
    {
        try {

            $condition = [];

            if (request()->has('title')) {
                $condition['title'] = request()->input('title');
            }


            $data = self::$model::with('setting_values:id,setting_title_id,value,title')->where($condition)->get();
            return entityResponse($data);
        } catch (\Exception $e) {

            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
