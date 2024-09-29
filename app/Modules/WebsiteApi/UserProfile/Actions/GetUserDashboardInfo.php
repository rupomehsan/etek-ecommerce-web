<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;

class GetUserDashboardInfo
{
    static $orderModel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;

    public static function execute()
    {
        try {

            // dd(auth()->id());
            $tototalOrders = self::$orderModel::where('user_id', auth()->user()->id)->count();
            $tototalPendingOrders = self::$orderModel::where('user_id', auth()->id())
                ->where("order_status", "pending")
                ->count();
            $tototalConfirmedOrders = self::$orderModel::where('user_id', auth()->id())
                ->where("order_status", "accepted")
                ->count();
            $tototalFinishedOrders = self::$orderModel::where('user_id', auth()->id())
                ->where("order_status", "delivered")
                ->count();


            $data = [
                "total_orders" => $tototalOrders,
                "total_pending_orders" => $tototalPendingOrders,
                "total_confirmed_orders" => $tototalConfirmedOrders,
                "total_finished_orders" => $tototalFinishedOrders,
            ];

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
