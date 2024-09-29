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
            $productCategoryBrands = self::$productBrandModel::whereHas('product_category_brands', function ($query) use ($category) {
                $query->where('product_category_id', $category->id)
                    ->where('total_product', '>', 0);
            })
                ->select('id', 'title', 'slug')
                ->orderBy('title', 'asc')
                ->withSum('product_category_brands', 'total_product')
                ->get();



            return entityResponse($productCategoryBrands);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
