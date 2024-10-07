<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllCategoryGroup
{
    static $CategoryGroupModel = \App\Modules\ProductManagement\ProductCategoryGroup\Models\Model::class;

    public static function execute($get_all = false)
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? [
                'id','title','slug','image'
            ];
            $with = [];
            $condition = [];

            $data = self::$CategoryGroupModel::query();

            if ($get_all || (request()->has('get_all') && (int)request()->input('get_all') === 1)) {
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
