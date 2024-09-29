<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllFeaturedProduct
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute()
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = ['product_image:id,product_id,url', 'product_categories:id,title', 'product_brand:id,title'];
            $condition = [];

            $data = self::$ProductModel::query()->where('is_featured', 1)->where('is_available', 1);

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {

                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get()
                    ->map(function ($item) {
                        if ($item->type == 'medicine') {
                            $item->load([
                                'medicine_product:id,product_id,p_generic_name,p_brand',
                                'medicine_product_verient' => function ($q) {
                                    $q->select(
                                        [
                                            "product_id",
                                            "id",
                                            "pv_b2c_discount_percent",
                                            "pv_b2c_price",
                                            "pv_b2c_mrp",
                                            "pv_b2b_discount_percent",
                                            "pv_b2b_price",
                                            "pv_b2b_mrp",

                                            "pv_b2c_max_qty",
                                            "pu_b2c_sales_unit_label",
                                            "pv_b2b_max_qty",
                                            "pu_b2b_sales_unit_label"
                                        ]
                                    );
                                }
                            ]);
                        }
                        return $item;
                    });
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit)
                    ->map(function ($item) {
                        $item->with([
                            'medicine_product:id,product_id,p_generic_name,p_brand',
                            'medicine_product_verient' => function ($q) {
                                $q->select(
                                    [
                                        "product_id",
                                        "id",
                                        "pv_b2c_discount_percent",
                                        "pv_b2c_price",
                                        "pv_b2c_mrp",
                                        "pv_b2b_discount_percent",
                                        "pv_b2b_price,pv_b2b_mrp",

                                        "pv_b2c_max_qty",
                                        "pu_b2c_sales_unit_label",
                                        "pv_b2b_max_qty",
                                        "pu_b2b_sales_unit_label"
                                    ]
                                );
                            }
                        ]);
                        return $item;
                    });
            }

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
