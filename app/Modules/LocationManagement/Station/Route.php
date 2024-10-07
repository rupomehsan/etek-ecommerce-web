<?php

use App\Modules\LocationManagement\Station\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('stations')->group(function () {
        Route::get('', [Controller::class,'index']);
        Route::get('{slug}', [Controller::class,'show']);
        Route::post('store', [Controller::class,'store']);
        Route::post('update/{slug}', [Controller::class,'update']);
        Route::post('soft-delete', [Controller::class,'softDelete']);
        Route::delete('destroy/{slug}', [Controller::class,'destroy']);
        Route::post('restore', [Controller::class,'restore']);
        Route::post('import', [Controller::class,'import']);
        Route::post('bulk-action', [Controller::class, 'bulkAction']);
    });
    // others api
    Route::get('/get-station-by-district-id/{district_id}', [Controller::class,'getStationByDistrictId']);
});
