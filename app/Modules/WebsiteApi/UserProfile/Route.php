<?php

use App\Modules\WebsiteApi\UserProfile\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('get-user-dashboard-info', [Controller::class,'getUserDashboardInfo']);
    Route::post('account-info-update', [Controller::class, 'AccountInfoUpdate']);
    Route::post('customers/account-info-update', [Controller::class, 'AccountInfoUpdate']);
    Route::post('address-info-update/{id}', [Controller::class, 'AddressInfoUpdate']);
    Route::post('customer-address-create', [Controller::class, 'AddressInfoCreate']);
    Route::post('update-profile-picture', [Controller::class, 'UpdateProfilePicture']);
    Route::post('change-password', [Controller::class, 'ChangePassword']);

    Route::post('set-default-address', [Controller::class, 'SetDefaultAddress']);
    Route::get('get-contact-person-by-address-id/{id}', [Controller::class, 'GetContactPersonByAddressId']);
    Route::get('get-single-address/{id}', [Controller::class, 'GetSingleAddress']);
});
