<?php

namespace App\Modules\ProductManagement\ProductCategory\Actions;

class Store
{
    static $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            $req_data = request()->except(['image']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $req_data['image'] = uploader($image, 'uploads/product_category');
            }

            $data = self::$model::query()->create($req_data);
            if ($data) {
                return messageResponse('Item added successfully', $data, 201);
            }

        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
