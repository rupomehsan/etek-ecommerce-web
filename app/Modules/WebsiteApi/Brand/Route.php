<?php

use App\Modules\WebsiteApi\Brand\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('get-all-brands', [Controller::class, 'GetAllBrand']);
    Route::get('get-all-featured-brands', [Controller::class, 'GetAllFeaturedBrand']);

});
