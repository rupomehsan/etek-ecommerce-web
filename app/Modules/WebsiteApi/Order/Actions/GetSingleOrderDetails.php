<?php

namespace App\Modules\WebsiteApi\Order\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetSingleOrderDetails
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;

    public static function execute($orderId)
    {
        try {
            $orderInfo = self::$model::with(
                'order_products',
                'order_products.product_image',
                'order_delivery_address:id,address,district_id,division_id,station_id',
                'order_delivery_address.division:id,name',
                'order_delivery_address.district:id,name',
                'order_delivery_address.station:id,name',
                'user',
            )
                ->where('order_id', $orderId)
                ->first();
            if (!$orderInfo) {
                return messageResponse('No order found', [], 200, 'success');
            }

            return $orderInfo;
        } catch (\Exception $e) {

            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    public static function generateUniqueOrderId()
    {
        $orderId = 'ETEK' . rand(1000000, 999999999);
        while (self::$model::where('order_id', $orderId)->exists()) {
            $orderId = 'ETEK' . rand(1000000, 999999999);
        }
        return $orderId;
    }
}
