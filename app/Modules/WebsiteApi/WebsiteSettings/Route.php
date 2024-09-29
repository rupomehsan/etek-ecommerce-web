<?php

use App\Modules\WebsiteApi\WebsiteSettings\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('get-website-settings', [Controller::class, 'GetWebsiteSettings']);
});
