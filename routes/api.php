<?php

use App\Http\Controllers\HomeController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\PaymentGateway\SSLCommerZ\Controller\SslCommerzPaymentController;

Route::prefix('v1')->group(function () {
    Route::any('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/send-order-email', function () {
        $email = "ok";
        $telegram = "ok";
        if (request()->email) {
            $order_details = \App\Modules\WebsiteApi\Order\Actions\GetSingleOrderDetails::execute(request()->order_id);
            try {
                send_order_mail($order_details, request()->email);
            } catch (\Throwable $th) {
                $email = "not ok. ".$th->getMessage();
            }

            try {
                try {
                    $delivery_address_details = json_decode($order_details->delivery_address_details);
                } catch (\Throwable $th) {
                    $delivery_address_details = (object) [];
                }

                $product_items = "";
                foreach ($order_details->order_products as $key => $cartItem) {
                    $sub_total = $cartItem->qty * $cartItem->price;
                    $product_items .= $key + 1 . ". " . $cartItem->product_name . "\n";
                    $product_items .= "৳ " . number_format($cartItem->price) . " x $cartItem->qty = ৳ " . number_format($sub_total) . "\n";
                    $product_items .=  "\n";
                }

                $address = $delivery_address_details->address;
                $address .= ", ".$delivery_address_details->station_name;
                $address .= ", ". $delivery_address_details->district_name;
                $address .= ", ". $delivery_address_details->division_name;

                sendToTelegram([
                    "date" => Carbon::now()->toDateTimeString(),
                    "user_name" => $delivery_address_details->user_name ?? '',
                    "phone" => $delivery_address_details->phone,
                    "address" => $address,
                    "order_id" => $order_details->order_id,
                    "product_items" => $product_items,
                    "total" => number_format($order_details->total),
                ]);
            } catch (\Throwable $th) {
                $telegram = "not ok. ".$th->getMessage();
            }
        }
        return response()->json([
            'telegram' => $telegram,
            'email' => $email,
        ]);
    });
});
