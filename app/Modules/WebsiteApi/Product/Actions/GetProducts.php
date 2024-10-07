<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use \App\Modules\ProductManagement\Product\Models\Model as ProductModel;

class GetProducts
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($search_key = null)
    {
        try {

            $varient_value_id = null;
            $brand_id = null;
            $priceOrderByType = "ASC";
            $is_available = 1;

            $key = $search_key;
            $pageLimit = request()->input('limit') ?? 32;
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

            if (request()->search_key) {
                $key = request()->search_key;
            }

            if (request()->priceOrderByType) {
                $orderByType = $priceOrderByType = request()->priceOrderByType;
            }

            if (request()->variant_values_id) {
                $varient_value_id = explode(',', request()->variant_values_id);
            }

            if (request()->brand_id) {
                $brand_id = explode(',', request()->brand_id);
            }

            $product_query = ProductModel::with($with);

            /** filter varitents */
            if ($varient_value_id) {
                $product_query->whereHas('product_verient_price', function ($q) use ($varient_value_id) {
                    if ($varient_value_id) {
                        $q->whereIn('product_varient_value_id', $varient_value_id);
                    }
                });
            }

            /** filter brand */
            if ($brand_id) {
                $product_query->whereIn('product_brand_id', $brand_id);
            }

            if ($key) {
                $product_query->where(function ($q) use ($key) {
                    $q->where('title', $key);
                    $q->orWhere('title', 'LIKE', "%" . $key);
                    $q->orWhere('title', 'LIKE', "%" . $key . "%");
                    $q->orWhere('meta_keywords', 'LIKE', "%" . $key . "%");
                    // $q->orWhere(function ($pq) use ($key) {
                    //     $pq->whereHas('product_brand', function ($bq) use ($key) {
                    //         $bq->where('title', $key);
                    //         $bq->orWhere('title', 'LIKE', "%" . $key);
                    //         $bq->orWhere('title', 'LIKE', "%" . $key . "%");
                    //     });
                    // });
                });
            }

            $product_query->where('is_available', $is_available)
                ->where('status', $status)
                ->where("customer_sales_price", ">", 0)
                ->select($fields);

            /** get min and max price */
            $min_price = $product_query->clone()->orderBy('customer_sales_price', 'ASC')->first()->customer_sales_price ?? 0;
            $max_price = $product_query->clone()->orderBy('customer_sales_price', 'DESC')->first()->customer_sales_price ?? 0;

            /** filter between min and max price */
            $product_query->orderBy("customer_sales_price", $priceOrderByType);

            if (request()->min && request()->max) {
                $product_query->whereBetween('customer_sales_price', [request()->min, request()->max]);
            }

            $data = $product_query->paginate($pageLimit);
            $data->withPath("/products?search_key=" . $key);

            return [
                "category" => $category ?? [],
                "childrens" => $childrens ?? [],
                "min_price" => $min_price ?? 0,
                "max_price" => $max_price ?? 0,
                "products" => $data->toArray(),
            ];
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
