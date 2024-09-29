<?php

use App\Modules\Auth\FacebookAuth\Controller;

use Illuminate\Support\Facades\Route;


Route::get('/facebook/auth/redirect', [Controller::class, 'AuthRedirectForLogin'])->name('auth.redirect');
Route::get('/facebook/auth/callback', [Controller::class, 'AuthCallBackAfterLogin'])->name('auth.calback');
