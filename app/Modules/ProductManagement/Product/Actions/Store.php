<?php

namespace App\Modules\ProductManagement\Product\Actions;

use Illuminate\Http\Request;

class Store
{
    
    static $model = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $productImageModel = \App\Modules\ProductManagement\Product\Models\ProductImageModel::class;

    public static function execute($request)
    {
        try {

            $requestData = $request->validated();
            $product_categories = $requestData['product_categories'];
            $product_images = $requestData['product_images'];
            unset($requestData['product_categories']);
            unset($requestData['product_images']);

            if ($product = self::$model::query()->create($requestData)) {

                self::productImagesUpload($request,  $product_images, ['id' => $product->id, 'title' => $product->title]);

                $product->product_categories()->attach($product_categories);

                StoreProductCategoryBrand($product_categories, $requestData['brand_id']);
                StoreProductCategoryVarients($request->varients, $product_categories);

                return messageResponse('Item added successfully', $product, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }


    public static function productImagesUpload(Request $request, $productImages, $productData)
    {
        if ($productImages  && count($productImages)) {

            foreach ($productImages as $key => $image) {
                $file = $request->file('images.' . $key);
                if ($file) {
                    $imagePath = uploader($file, "uploads/products");
                    self::$productImageModel::create([
                        'product_id' => $productData['id'],
                        'title' => $productData['title'],
                        'path' => $imagePath,
                        'alt' => $productData['title'],
                    ]);
                }
            }
        }
    }
}
