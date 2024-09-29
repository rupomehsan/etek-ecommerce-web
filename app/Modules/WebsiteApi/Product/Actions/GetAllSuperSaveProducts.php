<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllSuperSaveProducts
{
    static $offerProductModel = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;
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

            $productOffer = self::$offerProductModel::query()->where('id', 4)->first();


            if (!$productOffer) {
                return messageResponse('Category not found', $productOffer, 404, 'error');
            }


            $data = self::$ProductModel::query()
                ->whereExists(function ($query) use ($productOffer) {
                    $query->from('product_offer_product')
                        ->whereColumn('product_offer_product.product_id', 'products.id')
                        ->where('product_offer_product.product_offer_id', $productOffer->id);
                });



            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }



            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
