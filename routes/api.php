<?php

use App\Http\Controllers\HomeController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\PaymentGateway\SSLCommerZ\Controller\SslCommerzPaymentController;

Route::prefix('v1')->group(function () {
    Route::any('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
});
