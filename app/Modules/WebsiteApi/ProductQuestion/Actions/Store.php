<?php

namespace App\Modules\WebsiteApi\ProductQuestion\Actions;

class Store
{
    static $model = \App\Modules\WebsiteApi\ProductQuestion\Models\Model::class;
    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['user_id'] = auth()->id();
            $product = self::$productModel::where('slug', $request->slug)->first();
            $requestData['product_id'] = $product->id;
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Question send successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
