<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetProductCategoryWiseBrands
{
    static $categoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $productBrandModel = \App\Modules\ProductManagement\ProductBrand\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $category = self::$categoryModel::where('slug', $slug)->first();
            if (!$category) {
                return messageResponse('Category not found', $slug, 404, 'error');
            }

            $products = $category->products()
                ->where('is_available', 1)
                ->where('customer_sales_price', '>', 0)
                ->select([
                    'products.id',
                    'products.product_brand_id',
                ])->get();

            $brand_ids = $products->unique('product_brand_id')->map(function ($item) {
                return $item->product_brand_id;
            });

            $productCategoryBrands = self::$productBrandModel::whereIn('id', $brand_ids)->active()
                ->limit(30)
                ->select('id', 'title')
                ->withCount([
                    'products as total_products' => function ($q) use ($category) {
                        $q->where('is_available', 1)
                            ->whereHas('product_categories', function ($cq) use ($category) {
                                $cq->where('product_categories.id', $category->id);
                            });
                    }
                ])
                ->orderBy('title', 'ASC')
                ->get();

            // dd($productCategoryBrands->toArray(), $brand_ids);
            // $productCategoryBrands = self::$productBrandModel::query()
            //     ->whereHas(
            //         'product_category_brands',
            //         function ($query) use ($category) {
            //             $query->where('product_category_id', $category->id)
            //                 ->where('total_product', '>', 0);
            //         }
            //     )
            //     ->select('id', 'title', 'slug')
            //     ->orderBy('title', 'asc')
            //     ->withSum('product_category_brands', 'total_product')
            //     ->get();
            return entityResponse($productCategoryBrands);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
