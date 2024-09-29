<?php

use App\Modules\Auth\GoogleAuth\Controller;

use Illuminate\Support\Facades\Route;


Route::get('/google/auth/redirect', [Controller::class, 'AuthRedirectForLogin'])->name('auth.redirect');
Route::get('/google/auth/callback', [Controller::class, 'AuthCallBackAfterLogin'])->name('auth.calback');
