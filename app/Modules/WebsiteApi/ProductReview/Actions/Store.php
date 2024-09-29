<?php

namespace App\Modules\WebsiteApi\ProductReview\Actions;

class Store
{
    static $model = \App\Modules\WebsiteApi\ProductReview\Models\Model::class;
    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $reviewImageModel = \App\Modules\WebsiteApi\ProductReview\Models\ReviewImageModel::class;

    public static function execute($request)
    {
        try {
            // dd(request()->all());
            $requestData = request()->all();
            $product = self::$productModel::where('slug', $requestData['slug'])->first();
            // dd($product);
            if (!$product) {
                return messageResponse('Product not found...', $product, 404, 'error');
            }
            $storeData = [
                "user_id" =>  auth()->id(),
                "product_id" =>  $product->id,
                "rating" =>  $requestData['rating'],
                "description" =>  $requestData['review'],
            ];

            if ($data = self::$model::query()->create($storeData)) {
                if (request()->hasFile('review_images')) {
                    foreach ($requestData['review_images'] as $key => $image) {
                        $imageName = uploader($image, 'uploads/product/review_images');
                        self::$reviewImageModel::query()->create([
                            'user_id' => auth()->id(),
                            'product_review_id' => $data->id,
                            'product_id' => $product->id,
                            'image' => $imageName
                        ]);
                    }
                }
                return messageResponse('Thans for your review', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
