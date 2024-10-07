<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use Illuminate\Support\Facades\Cache;

class SearchProducts
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute()
    {
        try {

            $key = request()->key;
            $pageLimit = request()->input('limit') ?? 100;
            $orderByColumn = request()->input('sort_by_col') ?? 'customer_sales_price';
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

            $data = self::$ProductModel::query()
                ->active()
                ->where('is_available', 1)
                ->where('customer_sales_price', '>', 0)
                ->where(function ($q) use ($key) {
                    $q->where('title', $key);
                    $q->orWhere('title', 'LIKE', "%" . $key);
                    $q->orWhere('title', 'LIKE', "%" . $key."%");
                    $q->orWhere('meta_keywords', 'LIKE', "%" . $key . "%");
                    $q->orWhere(function ($pq) use ($key) {
                        $pq->whereHas('product_brand', function ($bq) use ($key) {
                            $bq->where('title', $key);
                            $bq->orWhere('title', 'LIKE', "%" . $key);
                            $bq->orWhere('title', 'LIKE', "%" . $key . "%");
                        });
                    });
                });

            $data
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit($pageLimit)
                ->orderBy($orderByColumn, $orderByType);

            $res_data = Cache::remember(
                'search_' . $key,
                (5 * 60),
                function ()
                use ($data) {
                    return $data->get();
                }
            );

            return $res_data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
