<?php

namespace App\Modules\WebsiteApi\SearchHandling\Actions;

class HomePageGlobalSearch
{
    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $productCategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $productBrandModel = \App\Modules\ProductManagement\ProductBrand\Models\Model::class;

    public static function execute()
    {
        try {
            // dd(request()->all());

            $searchKey = request()->input('search_key');

            $product = self::$productModel::with('product_image:product_id,url')
                ->where(function ($q) use ($searchKey) {
                    $q->where('title', $searchKey)
                        ->orWhere('title', 'like', '%' . $searchKey . '%')
                        ->orWhere('search_keywords', 'like', '%' . $searchKey . '%');
                })
                ->select([
                    'id',
                    'title',
                    'is_available',
                    'customer_sales_price',
                    'discount_type',
                    'discount_amount',
                    'slug',
                    'is_new',
                    "type"
                ])
                ->where("status", "active")
                ->paginate(request()->paginate ? request()->paginate : 12);

            $product->getCollection()->map(function ($item) {
                if ($item->type == "medicine") {
                    $item->medicine_product_verient = $item->medicine_product_verient()->select(
                        [
                            "product_id",
                            "id",

                            "pv_b2c_discount_percent",
                            "pv_b2c_price",
                            "pv_b2c_mrp",

                            "pv_b2b_discount_percent",
                            "pv_b2b_price",
                            "pv_b2b_mrp",
                        ]
                    )->first();
                    $item->load([
                        'medicine_product:id,product_id,p_generic_name,p_brand',
                    ]);
                }
            });

            $product->appends('search_key', $searchKey);

            $category = self::$productCategoryModel::where(function ($q) use ($searchKey) {
                $q->where('title', $searchKey);
                $q->orWhere('title', 'like', '%' . $searchKey . '%');
                $q->orWhere('search_keywords', 'like', '%' . $searchKey . '%');
            })
                ->limit(10)
                ->where("status", "active")
                ->paginate(10, ['title', 'slug', 'image']);

            $category->appends('search_key', $searchKey);

            $brand = self::$productBrandModel::where(function ($q) use ($searchKey) {
                $q->where('title', $searchKey);
                $q->orWhere('title', 'like', '%' . $searchKey . '%');
            })
                ->limit(10)
                ->where("status", "active")
                ->paginate(10, ['title', 'slug', 'image']);

            $brand->appends('search_key', $searchKey);

            $data = [
                "product" => $product,
                "category" => $category,
                "brand" => $brand,
            ];

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
