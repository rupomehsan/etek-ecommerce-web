<?php

use App\Modules\FileUploader\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('file-uploaders')->group(function () {
        Route::post('store', [Controller::class,'store']);
        Route::delete('destroy/{slug}', [Controller::class,'destroy']);
    });
});
