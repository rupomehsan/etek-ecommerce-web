<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use \App\Modules\ProductManagement\Product\Models\Model as ProductModel;
use \App\Modules\ProductManagement\ProductBrand\Models\Model as ProductBrandModel;

class GetBrandsByProduct
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($key = null)
    {
        try {
            $product_query = ProductModel::select('id', 'product_brand_id', 'title', 'meta_keywords');

            if (request()->search_key) {
                $key = request()->search_key;
            }

            if ($key) {
                $product_query->where(function ($q) use ($key) {
                    $q->where('title', $key);
                    $q->orWhere('title', 'LIKE', "%" . $key);
                    $q->orWhere('title', 'LIKE', "%" . $key . "%");
                    $q->orWhere('meta_keywords', 'LIKE', "%" . $key . "%");
                    $q->orWhere(function ($pq) use ($key) {
                        $pq->whereHas('product_brand', function ($bq) use ($key) {
                            $bq->where('title', $key);
                            $bq->orWhere('title', 'LIKE', "%" . $key);
                            $bq->orWhere('title', 'LIKE', "%" . $key . "%");
                        });
                    });
                });
            }

            $brand_ids = $product_query->get()->unique('product_brand_id')->pluck('product_brand_id');
            $brands = ProductBrandModel::select('id', 'title', 'image', 'slug')->whereIn('id', $brand_ids);

            $limit = request()->limit;
            if ($limit) {
                if ($limit > 30) {
                    $brands = $brands->paginate(30);
                } else {
                    $brands = $brands->paginate($limit > 5 ?  $limit : 5);
                }
            } else {
                $brands = $brands->limit(15)->get();
            }
            return $brands;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
