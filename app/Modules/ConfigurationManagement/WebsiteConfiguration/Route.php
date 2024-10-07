<?php

use App\Modules\ConfigurationManagement\WebsiteConfiguration\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('website-configurations')->group(function () {
        Route::get('get-setting-values', [Controller::class,'index']);

    });
});
