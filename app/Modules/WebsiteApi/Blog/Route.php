<?php

use App\Modules\WebsiteApi\Blog\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('get-all-blogs', [Controller::class, 'GetAllBlogs']);
    Route::get('get-single-blog/{slug}', [Controller::class, 'GetSingleBlog']);
});
