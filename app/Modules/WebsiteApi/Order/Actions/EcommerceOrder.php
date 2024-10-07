<?php

namespace App\Modules\WebsiteApi\Order\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Modules\ProductManagement\Product\Models\Model as ProductModel;

class EcommerceOrder
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;
    static $orderProductmodel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderProductModel::class;
    static $cartModel = \App\Modules\WebsiteApi\Cart\Models\Model::class;
    static $userModel = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute($request)
    {
        try {
            $orderDetails = $request->all();
            $user = null;
            $cartItems = json_decode(request()->cart_items);
            $user_type = 'ecommerce'; // ('ecommerce','retail_order')
            $user_slug = null;

            if(request()->user_slug){
                $user_slug = request()->user_slug;
            }
            if (auth()->check()) {
                $user_slug = auth()->user()->user_slug;
            }

            if($user_slug){
                $user = self::$userModel::where('slug', $user_slug)->with('role')->first();

                if ($user->role_serial == 6) {
                    $user_type = 'retail_order';
                }
            }

            // dd($request->all(), $cartItems);

            $total = $cartSubtotal = 0;
            foreach ($cartItems as $key => $item) {
                $product = ProductModel::where('id', $item->product_id)->first();
                $total += $product->current_price * $item->qty;
                $cartSubtotal = $total;

                $cartItems[$key]->current_price = $product->current_price;
                $cartItems[$key]->product_price = $product->product_price ?? $product->current_price;
                $cartItems[$key]->product_name = $product->title;
                $cartItems[$key]->final_price = $product->final_price;
            }

            $delivery_address_details = [
                "user_name" => $request->user_name,
                "phone" => $request->phone,
                "email" => $request->email,
                "address" => $request->address,
                "division_name" => DB::table('location_state_divisions')->where('id', $request->state_division_id)->first()?->name,
                "district_name" => DB::table('location_districts')->where('id', $request->district_id)->first()?->name,
                "station_name" => DB::table('location_stations')->where('id', $request->station_id)->first()?->name,
            ];

            $orderInfo = [
                "order_id" => self::generateUniqueOrderId(),
                "date" => Carbon::now()->toDateString(),
                "user_type" => $user_type,
                "user_id" => $user->id ?? null,
                "is_delivered" => 0,
                "delivery_address_details" => json_encode($delivery_address_details),
                "order_status" => 'pending',
                "delivery_method" => "home_delivery",
                "delivery_charge" => request()->delivery_charge ?? 0,
                "additional_charge" => 0,
                "product_coupon_id" => null,
                "coupon_discount" => null,
                "discount" => null,
                "discount_type" => null,
                "is_paid" => 0,
                "paid_amount" => 0,
                "paid_status" => 'due',
                "payment_method" => $orderDetails["payment_type"],

                "subtotal" => $cartSubtotal,
                "total" =>  $total + (request()->delivery_charge ?? 0),
            ];

            $order = self::$model::create($orderInfo);

            $product_items = "";
            foreach ($cartItems as $key => $cartItem) {

                $sub_total = $cartItem->qty * $cartItem->current_price;
                $total = $cartItem->qty * $cartItem->current_price;
                self::$orderProductmodel::create([
                    'sales_ecommerce_order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_price' => $cartItem->product_price,
                    'product_name' => $cartItem->product_name,
                    'discount_type' => null,
                    'tax' => null,
                    'price' => $cartItem->current_price,
                    'qty' => $cartItem->qty,
                    'subtotal' => $sub_total,
                    'tax_total' =>  0,
                    'total' => $total,
                ]);

                $product_items .= $key + 1 . ". " . $cartItem->product_name . "\n";
                $product_items .= "৳ " . ($cartItem->current_price) . " x $cartItem->qty = ৳ " . $sub_total . "\n";
                $product_items .=  "\n";
            }

            if ($user && $order->payment_method != 'online') {
                self::$cartModel::where('user_id', $user->id)->delete();
            }

            // $order_details = self::$model::with('user')->where('order_id', $orderInfo['order_id'])->first();
            $order_details = \App\Modules\WebsiteApi\Order\Actions\GetSingleOrderDetails::execute($order->order_id);

            return messageResponse('Order Successfully completed', $order_details, 200, 'success');
        } catch (\Exception $e) {
            // dd($e);
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
