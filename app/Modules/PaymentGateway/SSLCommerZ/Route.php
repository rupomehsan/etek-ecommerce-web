<?php


use Illuminate\Support\Facades\Route;
use App\Modules\PaymentGateway\SSLCommerZ\Controller\SslCommerzPaymentController;


// SSLCOMMERZ Start

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

//SSLCOMMERZ END

/*<<<<---- NOTE --->>>>>
|--------------------------------------------------------------------------
| Only one dependency on this package that is  api.php
|--------------------------------------------------------------------------
*/
