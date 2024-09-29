<?php

namespace App\Modules\ProductManagement\Product\Actions;

class Update
{
    static $model = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {


            if (!$product = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $product, 404, 'error');
            }
            $requestData = $request->validated();
            $product_categories = $requestData['product_categories'];
            $product_images = $requestData['product_images'];
            unset($requestData['product_categories']);
            unset($requestData['product_images']);
            $product->product_categories()->sync($product_categories);
            $product->product_images()->sync($product_images);
            $product->update($requestData);
            return messageResponse('Item updated successfully', $product, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
