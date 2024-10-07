<?php

namespace App\Modules\WebsiteApi\WebsiteSubscriber\Actions;

class Store
{
    static $model = \App\Modules\WebsiteApi\WebsiteSubscriber\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Thanks for subscribe', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
