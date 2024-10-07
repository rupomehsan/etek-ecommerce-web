<?php

namespace App\Modules\WebsiteApi\SliderAndBanner\Actions;

class HeroSliderSideBanner
{
    static $model = \App\Modules\BannerManagement\HomeSideBanner\Models\Model::class;

    public static function execute()
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'desc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = [];
            $condition = [];

            $data = self::$model::query();

            $data = $data
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit($pageLimit)
                ->orderBy($orderByColumn, $orderByType)
                ->first();

            return $data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
