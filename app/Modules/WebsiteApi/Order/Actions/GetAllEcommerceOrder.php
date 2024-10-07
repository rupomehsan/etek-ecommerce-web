<?php

namespace App\Modules\WebsiteApi\Order\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetAllEcommerceOrder
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;

    public static function execute()
    {
        try {


            $data = self::$model::with(
                'order_products',
                'order_products.product',
                'order_products.product.product_image'
            )
                ->where('user_id', auth()->id())
                ->paginate(10);
            if (!$data) {
                return messageResponse('No order found', [], 200, 'success');
            }


            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(1)->toRfc7231String());
            return $response;
        } catch (\Exception $e) {

            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }


}
