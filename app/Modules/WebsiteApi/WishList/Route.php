<?php

use App\Modules\WebsiteApi\WishList\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('get-wish-list-items', [Controller::class, 'index']);
    Route::post('add-to-wish-list', [Controller::class, 'store']);
    Route::delete('remove-wish-list-item/{id}', [Controller::class, 'destroy']);

});
