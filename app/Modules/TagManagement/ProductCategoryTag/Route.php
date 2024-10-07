<?php

use App\Modules\TagManagement\ProductCategoryTag\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('product-category-tags')->group(function () {
        Route::get('', [Controller::class,'index']);
        Route::get('{slug}', [Controller::class,'show']);
        Route::post('store', [Controller::class,'store']);
        Route::post('update/{slug}', [Controller::class,'update']);
        Route::post('soft-delete', [Controller::class,'softDelete']);
        Route::delete('destroy/{slug}', [Controller::class,'destroy']);
        Route::post('destroy/{slug}', [Controller::class,'destroy']);
        Route::post('restore', [Controller::class,'restore']);
        Route::post('import', [Controller::class,'import']);
        Route::post('bulk-action', [Controller::class, 'bulkAction']);
    });
});
