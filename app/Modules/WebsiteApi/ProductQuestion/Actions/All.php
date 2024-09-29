<?php

namespace App\Modules\WebsiteApi\ProductQuestion\Actions;

class All
{
    static $model = \App\Modules\WebsiteApi\ProductQuestion\Models\Model::class;
    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute()
    {
        try {
            $pageLimit = request()->input('limit') ?? 50;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'desc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = ['user'];
            $condition = [];

            $product = self::$productModel::where('slug', request()->input('slug'))->first();

            $data = self::$model::query()->where('product_id', $product->id);



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
            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(60)->toRfc7231String());
            return $response;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
