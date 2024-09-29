<?php

namespace App\Modules\WebsiteApi\Category\Actions;

use Illuminate\Support\Facades\DB;

class GetMinMaxPriceByCategoryId
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;


    public static function execute($slug)
    {
        try {

            $Category = self::$CategoryModel::where('slug', $slug)->first();
            if (!$Category) {
                return messageResponse('Data not found...', $slug, 404, 'error');
            }


            $prices = self::$ProductModel::query()
                ->whereHas('product_categories', function ($query) use ($Category) {
                    $query->where('product_category_id', $Category->id);
                })
                ->selectRaw('MIN(customer_sales_price) as min_price, MAX(customer_sales_price) as max_price')
                ->first();

            // Prepare the response data
            $data = [
                'min_price' => $prices->min_price,
                'max_price' => $prices->max_price,
            ];

            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(30)->toRfc7231String());
            return $response;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
