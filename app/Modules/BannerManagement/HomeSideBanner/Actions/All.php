<?php

namespace App\Modules\BannerManagement\HomeSideBanner\Actions;

class All
{
    static $model = \App\Modules\BannerManagement\HomeSideBanner\Models\Model::class;

    public static function execute($request)
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col');
            $orderByType = request()->input('sort_type');
            $status = request()->input('status');
            $fields = request()->input('fields');
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

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
