<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllFeaturedProduct
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($get_all = false, $limit = 10)
    {
        try {

            $pageLimit = request()->input('limit') ?? $limit;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? [
                'id',
                'title',
                'retailer_sales_price',
                'customer_sales_price',
                'b2b_discount_price',
                'b2c_discount_price',
                'is_available',
                'slug',
            ];
            $with = [
                'product_image:id,product_id,url',
                // 'product_categories:id,title',
                // 'product_brand:id,title'
            ];
            $condition = [];

            $data = self::$ProductModel::query()->where('is_featured', 1)->where('is_available', 1);

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
