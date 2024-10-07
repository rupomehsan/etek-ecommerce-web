<?php

namespace App\Modules\ProductManagement\ProductCategory\Actions;

class Update
{
    static $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            $req_data = request()->except(['image']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $req_data['image'] = uploader($image, 'uploads/product_category');
            }
            $data->update($req_data);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
