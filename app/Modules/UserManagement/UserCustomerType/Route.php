<?php

use App\Modules\UserManagement\UserCustomerType\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('user-customer-types', Controller::class);
    Route::post('user-customer-types/bulk-action', [Controller::class, 'bulkAction']);
});