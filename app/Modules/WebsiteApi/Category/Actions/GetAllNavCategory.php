<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllNavCategory
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute()
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? [
                'id',
                'title',
                'slug',
                'image',
                'is_nav',
                'parent_id',
                'image',
            ];
            $with = [];
            $condition = [];

            $data = self::$CategoryModel::query()->where('parent_id', 0)->where('is_nav', 1);

            $data = $data
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit(12)
                ->orderBy($orderByColumn, $orderByType)
                ->get();

            // if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
            // } else {
            //     $data = $data
            //         ->with($with)
            //         ->select($fields)
            //         ->where($condition)
            //         ->where('status', $status)
            //         ->orderBy($orderByColumn, $orderByType)
            //         ->paginate($pageLimit);
            // }

            return $data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
