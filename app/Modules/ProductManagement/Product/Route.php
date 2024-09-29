<?php

use App\Modules\ProductManagement\Product\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('products')->group(function () {
        Route::get('', [Controller::class, 'index']);
        Route::post('store', [Controller::class, 'store']);
        Route::post('update/{id}', [Controller::class, 'update']);
        Route::post('soft-delete', [Controller::class, 'softDelete']);
        Route::delete('destroy/{slug}', [Controller::class, 'destroy']);
        Route::post('destroy/{slug}', [Controller::class, 'destroy']);
        Route::post('restore', [Controller::class, 'restore']);
        Route::post('import', [Controller::class, 'import']);
        Route::post('bulk-action', [Controller::class, 'bulkAction']);
        //additional api//
        Route::get('max-min-price', [Controller::class, 'bulkAction']);
        Route::get('{categorySlug}/max-min-price', [Controller::class, 'bulkAction']);
        Route::get('{slug}/stock', [Controller::class, 'bulkAction']);
        Route::get('{categorySlug}/count', [Controller::class, 'bulkAction']);
        Route::get('{barandSlug}/count', [Controller::class, 'bulkAction']);

        Route::get('{barandSlug}/count', [Controller::class, 'bulkAction']);
        Route::get('{barandSlug}/count', [Controller::class, 'bulkAction']);

        Route::get('{slug}', [Controller::class, 'show']);
    });
});
