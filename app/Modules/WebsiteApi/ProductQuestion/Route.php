<?php

use App\Modules\WebsiteApi\ProductQuestion\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::post('customer-ecommerce-question', [Controller::class,'store']);
    Route::get('get-customer-ecommerce-question-and-answers', [Controller::class,'index']);

});
