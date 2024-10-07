<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllCategoryByCategoryGroupId
{
    static $CategoryGroupModel = \App\Modules\ProductManagement\ProductCategoryGroup\Models\Model::class;
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = [];
            $condition = [];

            $categoryGroup = self::$CategoryGroupModel::where('slug', $slug)->first();
            if (!$categoryGroup) {
                return messageResponse('Data not found...', $slug, 404, 'error');
            }

            $data = self::$CategoryModel::query()->where('product_category_group_id', $categoryGroup->id)->where('parent_id', 0);

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
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

            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(5)->toRfc7231String());
            return $response;

        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
