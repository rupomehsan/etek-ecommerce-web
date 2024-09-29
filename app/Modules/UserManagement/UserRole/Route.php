<?php

use App\Modules\UserManagement\UserRole\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('user-roles', Controller::class);
    Route::post('user-roles/bulk-action', [Controller::class, 'bulkAction']);
});