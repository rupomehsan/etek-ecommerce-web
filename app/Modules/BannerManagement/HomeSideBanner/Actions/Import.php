<?php

namespace App\Modules\BannerManagement\HomeSideBanner\Actions;

class Import
{
    static $model = \App\Modules\BannerManagement\HomeSideBanner\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "banner_one" => $row['banner_one'],

                    "banner_two" => $row['banner_two'],

                    "banner_three" => $row['banner_three'],

                    "banner_four" => $row['banner_four'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}