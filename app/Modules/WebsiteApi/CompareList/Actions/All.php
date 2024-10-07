<?php

namespace App\Modules\WebsiteApi\CompareList\Actions;

class All
{
    static $model = \App\Modules\WebsiteApi\CompareList\Models\Model::class;

    public static function execute($request)
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type')    ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = ['product:id,slug,title,purchase_price,customer_sales_price,type,discount_type,discount_amount', 'product.product_image:id,product_id,url'];

            $condition = [];

            $data = self::$model::query()->where('user_id', auth()->id());

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->where('title', $searchKey);
                    $q->orWhere('description', 'like', '%' . $searchKey . '%');
                });
            }

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
                        if ($item->product->type == 'medicine') {
                            $item->product->load(['medicine_product', 'medicine_product_verient']);
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
                    ->paginate($pageLimit);
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
