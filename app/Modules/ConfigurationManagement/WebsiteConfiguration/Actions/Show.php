<?php

namespace App\Modules\ConfigurationManagement\WebsiteConfiguration\Actions;



class Show
{
    static $model = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;

    public static function execute($slug)
    {
        try {
            $with = ['setting_values'];
            $fields = request()->input('fields') ?? [];
            if (empty($fields)) {
                $fields = ['*'];
            }
            if (!$data = self::$model::query()->with($with)->select($fields)->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
