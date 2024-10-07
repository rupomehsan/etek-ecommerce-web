<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllCategory
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute()
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = [];
            $condition = [];

            $data = self::$CategoryModel::query()->whereIn('parent_id', [0, null]);

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                if (request()->has('all_parent') && (int)request()->input('all_parent') === 1) {

                    $data = $data
                        ->with($with)
                        ->select($fields)
                        ->where($condition)
                        ->where('status', $status)
                        ->orderBy($orderByColumn, $orderByType)
                        ->get();
                } else {

                    $data = $data
                        ->with($with)
                        ->select($fields)
                        ->where($condition)
                        ->where('status', $status)
                        ->limit($pageLimit)
                        ->orderBy($orderByColumn, $orderByType)
                        ->get();
                }
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
