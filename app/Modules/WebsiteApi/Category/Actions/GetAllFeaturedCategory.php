<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllFeaturedCategory
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($all = false, $limit = 10)
    {
        try {

            $pageLimit = request()->input('limit') ?? $limit;
            $orderByColumn = request()->input('sort_by_col') ?? 'serial';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? [
                'id',
                'slug',
                'title',
                'image',
                'is_featured',
            ];
            $with = [];
            $condition = [
                "is_featured" => 1,
            ];

            $data = self::$CategoryModel::query();

            if ($all || (request()->has('get_all') && (int)request()->input('get_all') === 1)) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }

            return $data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
