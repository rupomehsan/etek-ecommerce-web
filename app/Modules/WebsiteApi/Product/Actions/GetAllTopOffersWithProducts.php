<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllTopOffersWithProducts
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $offerProductModel = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;
    public static function execute()
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = ['product_images:id,product_id,url', 'product_categories:id,title', 'product_brand:id,title'];
            $condition = [];

          $data = self::$offerProductModel::with('products','products.product_image')->get();

  


            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
