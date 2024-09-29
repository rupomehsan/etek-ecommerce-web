<?php

use App\Modules\Ecommerce\CustomerWishlist\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('customer-wishlists')->group(function () {
        Route::get('', [Controller::class,'index']);

    });
});
