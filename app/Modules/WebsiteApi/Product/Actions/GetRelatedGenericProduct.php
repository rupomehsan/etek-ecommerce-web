<?php

namespace App\Modules\WebsiteApi\Product\Actions;

use Illuminate\Support\Facades\DB;
use App\Modules\ProductManagement\Product\Models\MedicineProductModel;

use function Laravel\Prompts\select;

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
            $with = ['product_image:id,product_id,url'];
            $condition = [];

            $data = self::$ProductModel::query()->where('slug', $slug)->first();

            $genericProduct = self::$ProductModel::with($with)->select('id', 'title', 'slug', 'customer_sales_price', 'retailer_sales_price')->where('product_medicine_generic_id', $data->product_medicine_generic_id)->limit($pageLimit)->where('id', '!=', $data->id)->get();



            return entityResponse($genericProduct);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
