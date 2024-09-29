<?php

namespace App\Modules\BannerManagement\HomeBanner\Actions;

class Store
{
    static $model = \App\Modules\BannerManagement\HomeBanner\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $requestData['image'] = uploader($image, 'uploads/banner');
            }
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
