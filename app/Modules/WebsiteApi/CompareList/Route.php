<?php

use App\Modules\WebsiteApi\CompareList\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('get-compare-list-items', [Controller::class, 'index']);
    Route::post('add-to-compare-list', [Controller::class, 'store']);
    Route::delete('remove-compare-list-item/{id}', [Controller::class, 'destroy']);
});
