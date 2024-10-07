<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class GetProductCategoryVarients
{
    static $categoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $productCategoryVarientModel = \App\Modules\ProductManagement\Product\Models\ProductCategoryVarientModel::class;
    static $productVarientModel = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;
    static $productVarientValue = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $varients = [];

            $category = self::$categoryModel::where('slug', $slug)->first();
            if (!$category) {
                return messageResponse('Category not found', $slug, 404, 'error');
            }

            // Eager load the related product variants and their values
            $productCategoryVariants = self::$productCategoryVarientModel::where('product_category_id', $category->id)
                ->with(['productVarient', 'productVarientValue']);

            if (request()->brand_id) {
                $productCategoryVariants->whereExists(function (Builder $query) use ($category) {
                    $query->select(DB::raw(1))
                        ->from('product_category_brand')
                        ->where('product_category_brand.product_category_id', 5)
                        ->whereIn('product_category_brand.product_brand_id', request()->brand_id);
                    // dd(request()->brand_id);
                });
            }

            $productCategoryVariants = $productCategoryVariants->get();

            $variantMap = [];

            foreach ($productCategoryVariants as $variant) {
                $variantId = $variant->product_varient_id;
                $variantValueId = $variant->product_varient_value_id;

                if (!isset($variantMap[$variantId])) {
                    $variantMap[$variantId] = [
                        'varient_details' => [
                            'id' => $variant->productVarient->id,
                            'title' => $variant->productVarient->title,
                            'slug' => $variant->productVarient->slug,
                        ],
                        'values' => []
                    ];
                }

                $valueExists = false;
                foreach ($variantMap[$variantId]['values'] as $value) {
                    if ($value['varient_value_details']['id'] == $variantValueId) {
                        $valueExists = true;
                        break;
                    }
                }

                if (!$valueExists) {
                    $variantMap[$variantId]['values'][] = [
                        'varient_value_details' => [
                            'id' => $variant->productVarientValue->id,
                            'title' => $variant->productVarientValue->title,
                            'slug' => $variant->productVarientValue->slug,
                        ],
                    ];
                }
            }

            // Convert the map to the desired array format
            $varients = array_values($variantMap);

            return entityResponse($varients);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
/**
 [
    {
    "varient_details": {},
    "values": [
        {
            "varient_value_details": {}
        }
    ]
  },
 ]
 */
