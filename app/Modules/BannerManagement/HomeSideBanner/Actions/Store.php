<?php

namespace App\Modules\BannerManagement\HomeSideBanner\Actions;

class Store
{
    static $model = \App\Modules\BannerManagement\HomeSideBanner\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            if ($request->hasFile('banner_one')) {
                $image = $request->file('banner_one');
                $requestData['banner_one'] = uploader($image, 'uploads/banner');
            }
            if ($request->hasFile('banner_two')) {
                $image = $request->file('banner_two');
                $requestData['banner_two'] = uploader($image, 'uploads/banner');
            }
            if ($request->hasFile('banner_three')) {
                $image = $request->file('banner_three');
                $requestData['banner_three'] = uploader($image, 'uploads/banner');
            }
            if ($request->hasFile('banner_four')) {
                $image = $request->file('banner_four');
                $requestData['banner_four'] = uploader($image, 'uploads/banner');
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
