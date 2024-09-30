<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use Illuminate\Support\Facades\DB;
use App\Modules\ProductManagement\Product\Models\MedicineProductModel;

class GetRelatedGenericProduct
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($slug)

    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = ['product_image:id,product_id,url', 'product_categories:id,title', 'product_brand:id,title'];
            $condition = [];

            $data = self::$ProductModel::query()->with('medicine_product')->where('slug', $slug)->first();

            if ($data && $data->medicine_product) {
                $geniric = DB::table('product_medicine_generics')
                    ->where('title', $data->medicine_product->p_generic_name)
                    ->first();

                $related_brand_product = [];
                if ($geniric) {

                    $related_brand_product = MedicineProductModel::where('p_generic_id', $geniric->id)
                        ->select([
                            'product_id',
                            'p_name',
                            'p_brand',
                            'p_manufacturer',
                            'p_generic_id',
                        ])
                        ->with([
                            'varient' => function ($q) {
                                $q->select([
                                    'product_id',
                                    'pv_b2c_price',
                                    'pv_b2b_price'
                                ]);
                            },
                            'product' => function ($q) {
                                $q->select([
                                    'id',
                                    'title',
                                    'type',
                                    'slug',
                                ])
                                    ->with(['product_image:id,product_id,url']);
                            }
                        ])
                        ->get();
                }
                return entityResponse($related_brand_product);
            }
            return entityResponse([]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
