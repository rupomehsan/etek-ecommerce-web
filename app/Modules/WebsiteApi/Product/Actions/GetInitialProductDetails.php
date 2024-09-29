<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use App\Modules\ProductManagement\Product\Models\MedicineProductModel;
use Illuminate\Support\Facades\DB;

class GetInitialProductDetails
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $with = [
                'product_image:id,product_id,url',
                'product_categories:id,title',
                'product_brand:id,title,image',
                'product_region',
                'product_region.country',
            ];

            $fields = request()->input('fields') ?? ['*'];
            if (empty($fields)) {
                $fields = ['*'];
            }

            $data = self::$ProductModel::query()
                ->with($with)
                ->select($fields)
                ->where('slug', $slug)
                ->first();

            if ($data->type == 'medicine') {
                $data->load([
                    'medicine_product:id,product_id,p_description,p_strength,p_generic_name',
                    'medicine_product_verient:id,product_id,pu_b2c_base_unit_multiplier,pu_base_unit_label,pu_b2c_sales_unit_label,pu_base_unit_multiplier,pv_b2c_price,pv_b2c_mrp,pv_b2c_discount_percent,pv_b2c_max_qty',
                ]);
            }

            $data->product_images = $data->product_images()->select('id', 'product_id', 'url')->skip(1)->take(10)->get();

            return $data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
