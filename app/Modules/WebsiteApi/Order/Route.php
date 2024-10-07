<?php

use App\Modules\WebsiteApi\Order\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    // ->middleware('auth:api')
    ->group(function () {
        Route::post('customer-ecommerce-order-placed', [Controller::class, 'EcommerceOrder']);
        Route::get('get-all-customer-ecommerce-order', [Controller::class, 'GetAllEcommerceOrder']);
        Route::get('get-single-order-details/{orderId}', [Controller::class, 'GetSingleOrderDetails']);
    });
