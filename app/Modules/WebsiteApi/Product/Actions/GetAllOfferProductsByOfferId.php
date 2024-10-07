<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllOfferProductsByOfferId
{
    static $offerProductModel = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;
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

            $productOffer = self::$offerProductModel::query()->where('slug', $slug)->first();

            if (!$productOffer) {
                return messageResponse('Category not found', $slug, 404, 'error');
            }


            $data = self::$ProductModel::query()
                // ->where('is_available', 1)
                ->whereHas('offer_products', function ($query) use ($productOffer) {
                    $query->where('product_offer_id', $productOffer->id);
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

            $response = [
                'productOfferDetails' => $productOffer,
                "data" => $data
            ];

            return entityResponse($response);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
