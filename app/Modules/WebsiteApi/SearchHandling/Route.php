<?php

use App\Modules\WebsiteApi\SearchHandling\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('home-page-global-search', [Controller::class,'HomePageGlobalSearch']);

});
