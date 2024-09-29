<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllTopOffersWithProducts
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $offerProductModel = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;
    public static function execute()
    {
        try {

            $data = self::$offerProductModel::with('products','products.product_image')->get();

            return entityResponse($data);
            
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
