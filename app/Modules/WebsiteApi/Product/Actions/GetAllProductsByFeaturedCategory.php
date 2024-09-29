<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllProductsByFeaturedCategory
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute()
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $with = [];
            $condition = [];
            $fields = [
                "products.id",
                "title",
                "short_description",
                "customer_sales_price",
                "discount_type",
                "discount_amount",
                "product_brand_id",
                "sku",
                "type",
                "slug",
                "is_available"
            ];

            $data = self::$CategoryModel::where('is_featured', 1)
                ->select('id', 'title', 'is_featured', 'slug', 'image')
                ->with([
                    'products' => function ($q) use ($fields, $pageLimit) {
                        $q->select($fields)
                            ->where('status', 'active')
                            ->limit($pageLimit)
                            ->with([
                                'product_image' => function ($q) {
                                    $q->select('id', 'product_id', 'url');
                                },
                                'medicine_product_verient' => function ($q) {
                                    $q->select(
                                        'id',
                                        'product_id',
                                        'pv_mrp',
                                        'pv_b2c_discounted_price',
                                        'pv_b2c_min_qty',
                                        'pv_b2c_max_qty',
                                        'pv_b2b_discounted_price',
                                        'pv_b2b_min_qty',
                                        'pu_base_unit_multiplier',
                                        'pu_b2c_base_unit_multiplier',
                                        'pu_b2b_base_unit_multiplier',
                                        'pu_b2c_sales_unit_id',
                                        'pu_b2b_sales_unit_id',
                                        'pv_b2c_discount_percent',
                                        'pv_b2b_discount_percent',
                                        'pv_b2b_max_qty',
                                        'pv_b2c_price',
                                        'pv_b2c_mrp',
                                        'pv_b2b_price',
                                        'pv_b2b_mrp'
                                    );
                                }
                            ]);
                    }
                ])->get();

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
