<?php

namespace App\Modules\WebsiteApi\CompareList\Actions;

class Store
{
    static $model = \App\Modules\WebsiteApi\CompareList\Models\Model::class;

    public static function execute($request)
    {
        try {
            $isCompareListExist = self::$model::where('product_id', request()->product_id)->where('user_id', auth()->id())->first();

            if ($isCompareListExist) {
                return messageResponse('Item already added', $isCompareListExist, 200,'warning');
            }

            $requestData = [
                'product_id' => request()->product_id,
                'user_id' =>  auth()->id(),
            ];

            $data = self::$model::query()->create($requestData);
            return messageResponse('Item added into compare list', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
