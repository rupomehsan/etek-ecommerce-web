<?php

use App\Modules\WebsiteApi\ProductReview\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::post('submit-product-review', [Controller::class, 'store']);
});
