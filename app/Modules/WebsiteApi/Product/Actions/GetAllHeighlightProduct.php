<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllHeighlightProduct
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($get_all = false, $limit = 10)
    {
        try {

            $pageLimit = request()->input('limit') ?? $limit;
            $orderByColumn = request()->input('sort_by_col') ?? 'updated_at';
            $orderByType = request()->input('sort_type') ?? 'desc';
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

            $new_products = self::$ProductModel::query()
                ->where('is_new', 1)
                ->where('is_available', 1)
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit($pageLimit)
                ->orderBy($orderByColumn, $orderByType)
                ->get();

            $best_selling_products = self::$ProductModel::query()
                ->where('is_best_selling', 1)
                ->where('is_available', 1)
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit($pageLimit)
                ->orderBy($orderByColumn, $orderByType)
                ->get();

            $trending_products = self::$ProductModel::query()
                ->where('is_trending', 1)
                ->where('is_available', 1)
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit($pageLimit)
                ->orderBy($orderByColumn, $orderByType)
                ->get();

            return [
                "new_products" => $new_products,
                "best_selling_products" => $best_selling_products,
                "trending_products" => $trending_products,
            ];
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
