<?php

use App\Modules\WebsiteApi\Product\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('products', [Controller::class, 'GetProducts']);
    Route::get('search-products', [Controller::class, 'SearchProducts']);
    Route::get('product-brands', [Controller::class, 'GetBrandsByProduct']);

    Route::get('get-all-products', [Controller::class, 'GetAllProduct']);
    Route::get('get-all-best-selling-products', [Controller::class, 'GetAllBestSellingProduct']);

    Route::get('get-initial-product-details/{slug}', [Controller::class, 'GetInitialProductDetails']);
    Route::get('get-product-details/{slug}', [Controller::class, 'GetProductDetails']);
    Route::get('get-related-generic-products/{slug}', [Controller::class, 'GetRelatedGenericProduct']);

    Route::get('get-all-featured-products', [Controller::class, 'GetAllFeaturedProduct']);
    Route::get('get-all-featured-products-by-category-id/{slug}', [Controller::class, 'GetAllFeaturedProductsByCategoryId']);
    Route::get('get-all-products-by-brand-id/{slug}', [Controller::class, 'GetAllProductsByBrandId']);

    Route::get('get-all-products-by-category-id/{slug}', [Controller::class, 'GetAllProductsByCategoryId']);
    Route::get('get-all-products-by-category-id-with-verient-and-brand/{slug}', [Controller::class, 'GetAllProductsByCategoryIdWithVerientAndBrand']);

    Route::get('get-all-top-product-offer', [Controller::class, 'GetAllProductOffers']);
    Route::get('get-all-top-products-offer-by-offer-id/{slug}', [Controller::class, 'GetAllOfferProductsByOfferId']);
    Route::get('get-all-products-and-single-group-by-category-group-id/{slug}', [Controller::class, 'GetSingleCategoryGroupWithProduct']);

    Route::get('get-product-category-varients/{slug}', [Controller::class, 'GetProductCategoryVarients']);
    Route::get('get-product-category-brands/{slug}', [Controller::class, 'GetProductCategoryBrands']);


});
