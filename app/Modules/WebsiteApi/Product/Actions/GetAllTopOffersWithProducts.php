<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllTopOffersWithProducts
{
    static $offerProductModel = \App\Modules\ProductManagement\ProductOffer\Models\Model::class;

    public static function execute()
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? ['*'];
            $getAll = request()->input('get_all') ?? 0;


            $with = [
                'offer_products' => function ($query) use ($fields) {
                    $query->select($fields);
                }
            ];

            $query = self::$offerProductModel::with($with)
                ->where('status', $status)
                ->orderBy($orderByColumn, $orderByType);

            if (!empty($getAll) && (int)$getAll === 1) {
                $data = $query->get();
            } else {
                // Paginate results
                $data = $query->paginate($pageLimit);
            }

            return entityResponse($data);

        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
