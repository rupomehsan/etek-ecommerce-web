<?php

namespace App\Modules\WebsiteApi\Cart\Actions;

class Destroy
{
    static $model = \App\Modules\WebsiteApi\Cart\Models\Model::class;

    public static function execute($id)
    {
        try {
            if(auth()->check()){
                self::$model::where('product_id', $id)->where('user_id',auth()->user()->id)->delete();
            }
            return messageResponse('Cart item successfully deleted',[], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
