<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| be assigned to the "web" middleware group. Make something great!
|
*/
// git rm --cached --ignore-unmatch storage/log/oauth-private.zip

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'Website\WebsiteController@home')->name('website_home');

    Route::get('/blogs', 'Website\WebsiteController@blogs')->name('website_blogs');
    Route::get('/blog-details/{slug}', 'Website\WebsiteController@blogDetails')->name('website_blog_details');

    Route::get('/products/{slug}', 'Website\WebsiteController@products')->name('website_products');
    Route::get('/category/{slug}', 'Website\WebsiteController@categoryProducts')->name('category_products');
    Route::get('/brand/{slug}', 'Website\WebsiteController@brandProducts')->name('brand_products');
    Route::get('/category-group/{slug}', 'Website\WebsiteController@category_group_products')->name('category_group_products');

    Route::get('/product-details/{slug}', 'Website\WebsiteController@products_details')->name('website_products_details');
    Route::get('/offer-products/{slug}', 'Website\WebsiteController@offer_products')->name('offer_products');

    Route::get('/cart', 'Website\WebsiteController@cart')->name('website_cart');
    Route::get('/checkout', 'Website\WebsiteController@checkout')->name('website_checkout');

    Route::get('/contact', 'Website\WebsiteController@contact')->name('website_contact');
    Route::get('/about', 'Website\WebsiteController@about')->name('website_about');
    Route::get('/terms-conditions', 'Website\WebsiteController@terms_conditions')->name('website_terms_conditions');
    Route::get('/privacy-policy', 'Website\WebsiteController@privacy_policy')->name('website_privacy_policy');
    Route::get('/returns-exchanges', 'Website\WebsiteController@returns_exchanges')->name('website_returns_exchanges');
    Route::get('/shipping-delivery', 'Website\WebsiteController@shipping_delivery')->name('website_shipping_delivery');
    Route::get('/search-results', 'Website\WebsiteController@search_results')->name('search_results');
    Route::get('/invoice', 'Website\WebsiteController@invoice');

    Route::get('/profile', 'Website\ProfileController@profile')->name('website_profile');
    Route::get('/profile/orders', 'Website\ProfileController@orders')->name('website_profile_orders');
    Route::get('/profile/order-details/{slug}', 'Website\ProfileController@order_details')->name('order_details');
    Route::get('/profile/wish-list', 'Website\ProfileController@wish_list')->name('website_profile_wish_list');
    Route::get('/profile/compare-list', 'Website\ProfileController@compare_list')->name('website_profile_compare_list');
    Route::get('/profile/account', 'Website\ProfileController@account')->name('website_profile_account');
    Route::get('/profile/address', 'Website\ProfileController@address')->name('website_profile_address');
    Route::get('/profile/password', 'Website\ProfileController@password')->name('website_profile_password');

    Route::post('/profile/edit-account', 'Website\ProfileController@edit_account')->name('website_edit_account')->middleware('auth:api');
    Route::post('/profile/edit-address', 'Website\ProfileController@edit_address')->name('website_edit_address');
    Route::get('/profile/address/create', 'Website\ProfileController@address_create')->name('website_address_create');

    Route::get('/login', 'Website\AuthController@login')->name('login');
    Route::get('/register', 'Website\AuthController@register')->name('register');
    Route::get('/retailer-register', 'Website\AuthController@retailerRegister')->name('retailerRegister');

    Route::get('/uploads_variant', 'Website\TestController@uploads_variant');
    Route::get('/attach_category_into_products', 'Website\TestController@attach_category_into_products');

    Route::get('/product_and_category_upload', 'Website\TestController@product_and_category_upload');
    // Route::get('/upload_categories', 'Website\TestController@upload_categories');
    Route::get('/set_category_image', 'Website\TestController@set_category_image');
    Route::get('/set_nav_category', 'Website\TestController@set_nav_category');

    Route::get('/upload_product_list', 'Website\TestController@upload_product_list');
    Route::get('/upload_product', 'Website\TestController@upload_product');
});

Route::post('verify-user-otp', [\App\Modules\Auth\Controller::class, 'VerifyOtp']);
Route::post('logout', function(){
    auth()->logout();
});

Route::get('/auth-info',function(){
    dd(auth()->user());
});

require_once __DIR__ . '/ssl_route.php';
require_once __DIR__ . '/test_route.php';
require_once __DIR__ . '/oauth_route.php';


// Route::get('/tt', function () {

//     Storage::disk('etek')->putFileAs("uploads/banner", public_path("avatar.png"), "shefat-text.png");

//     return 0;
//     $images = DB::table('product_images')
//         ->where('url', 'LIKE', '%\%20%')
//         // ->where('product_id', 67553)
//         // ->take(2)
//         ->get();

//     foreach ($images as $key => $image) {
//         $currentFilePath = public_path($image->url);
//         $newFileName = str_replace('%20', '-', basename($currentFilePath)); // Replace '%20' with '-'
//         $newFilePath = dirname($currentFilePath) . '/' . $newFileName;

//         if (rename($currentFilePath, $newFilePath)) {
//             DB::table('product_images')
//                 ->where('id', $image->id)
//                 ->update([
//                     'url' => "uploads/products/".$image->product_id."/".$newFileName,
//                 ]);
//             echo "File renamed successfully to: $newFilePath </br>";
//         } else {
//             echo "<mark>Failed to rename file.</mark>";
//         }
//         // dd($newFileName, $newFilePath);
//     }
//     // dd($images);
// });
// Route::get('/t', function () {
//     function readAllFilesFromFolder($directory)
//     {
//         $files = [];
//         $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
//         foreach ($iterator as $file) {
//             if ($file->isDir()) {
//                 continue;
//             }
//             $files[] = str_replace('\\', '/', $file->getPathname());
//         }
//         return $files;
//     }
//     $directory = public_path('uploads/files');
//     $fileList = readAllFilesFromFolder($directory);

//     foreach ($fileList as $currentFilePath) {
//         $newFileName = str_replace('%20', '-', basename($currentFilePath)); // Replace '%20' with '-'
//         $newFilePath = dirname($currentFilePath) . '/' . $newFileName;
//         if (rename($currentFilePath, $newFilePath)) {
//             echo "File renamed successfully to: $newFilePath";
//         } else {
//             echo "Failed to rename file.";
//         }
//     }
//     dd($fileList);
// });


