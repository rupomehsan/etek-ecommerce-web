<?php

use App\Modules\UserManagement\UserSupplierType\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('user-supplier-types', Controller::class);
    Route::post('user-supplier-types/bulk-action', [Controller::class, 'bulkAction']);
});