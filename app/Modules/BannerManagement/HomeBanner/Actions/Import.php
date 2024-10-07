<?php

namespace App\Modules\BannerManagement\HomeBanner\Actions;

class Import
{
    static $model = \App\Modules\BannerManagement\HomeBanner\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "short_des" => $row['short_des'],

                    "offer_title" => $row['offer_title'],

                    "button_url" => $row['button_url'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}