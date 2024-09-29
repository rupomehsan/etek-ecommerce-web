<?php

namespace App\Modules\WebsiteApi\WishList\Actions;

class Store
{
    static $model = \App\Modules\WebsiteApi\WishList\Models\Model::class;

    public static function execute()
    {
        try {
            $isWishListExist = self::$model::where('product_id', request()->product_id)->where('user_id', auth()->id())->first();

            if ($isWishListExist) {
                return messageResponse('Item already added', $isWishListExist, 200, 'warning');
            }

            $requestData = [
                'product_id' => request()->product_id,
                'user_id' =>  auth()->id(),
            ];

            $data = self::$model::query()->create($requestData);
            return messageResponse('Item added into wishlist', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
