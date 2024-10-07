<?php

use App\Modules\WebsiteApi\SliderAndBanner\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('get-home-page-hero-sliders', [Controller::class, 'HeroSlider']);
    Route::get('get-home-page-hero-slider-side-banners', [Controller::class, 'HeroSliderSideBanner']);
});
