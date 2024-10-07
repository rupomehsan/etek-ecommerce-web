<?php

use App\Mail\OrderSuccessEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// git rm --cached --ignore-unmatch storage/log/oauth-private.zip

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'Website\WebsiteController@home')->name('website_home');
    Route::get('/search-products', 'Website\WebsiteController@mobile_search')->name('website_mobile_search');

    Route::get('/blogs', 'Website\WebsiteController@blogs')->name('website_blogs');
    Route::get('/blog-details/{slug}', 'Website\WebsiteController@blogDetails')->name('website_blog_details');

    Route::get('/products', 'Website\WebsiteController@all_products')->name('search_results');
    Route::get('/shop/{slug}', 'Website\WebsiteController@shop')->name('shop');
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
    Route::get('/returns-exchanges', 'Website\WebsiteController@returns_exchanges')->name('website_returns_exchanges');
    Route::get('/shipping-delivery', 'Website\WebsiteController@shipping_delivery')->name('website_shipping_delivery');
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

    // Route::get('/uploads_variant', 'Website\TestController@uploads_variant');
    // Route::get('/attach_category_into_products', 'Website\TestController@attach_category_into_products');

    // Route::get('/product_and_category_upload', 'Website\TestController@product_and_category_upload');
    // Route::get('/upload_categories', 'Website\TestController@upload_categories');
    // Route::get('/set_category_image', 'Website\TestController@set_category_image');
    // Route::get('/set_nav_category', 'Website\TestController@set_nav_category');

    // Route::get('/upload_product_list', 'Website\TestController@upload_product_list');
    // Route::get('/upload_product', 'Website\TestController@upload_product');
});

Route::post('verify-user-otp', [\App\Modules\Auth\Controller::class, 'VerifyOtp']);
Route::post('logout', function () {
    auth()->logout();
});

Route::get('/auth-info', function () {
    dd(auth()->user());
});
Route::post('/custom-auth', function () {
    $user = App\Modules\UserManagement\User\Models\Model::where('slug', request()->slug)->first();
    auth()->login($user);
    return '';
});

Route::view('email', 'mails.order_success', ["order" => \App\Modules\WebsiteApi\Order\Actions\GetSingleOrderDetails::execute("ETEK280933206")]);
Route::view('update_price', 'update_price');

Route::get('set_cat',function(){
    $titles = [
        "Dr. Biswas Good Health",
        "Myotreat",
        "Centrum Women Multivitamin Supplement 120 Tablets",
        "Ultrox",
        "Centrum Silver Multivitamin For Men (Men+50) 100 Tablets",
        "Centrum Silver Multivitamin For Women (Women+50) 65 Tablets",
        "EPO-EC",
        "Centrum Silver Multivitamin For Women 100 Tablets",
        "Sunex-B",
        "Nature's Bounty Fish Oil (Omega-3) 200 Capsules",
        "Blackmores Omega-3 Fish Oil 1000mg 120 Capsules",
        "KIRKLAND Signature Sustainably Sourced Fish Oil 1000mg Helps Supports A Healthy Heart",
        "Rowan-D",
        "Dcium",
        "Super Kids Drop",
        "Nature's Bounty Fish Oil (Omega-3) 1200mg 120 Capsules",
        "One A Day Mens 100ct Size One A Day Men'S Multivitamin Multimineral Supplement Tablets 100 Count",
        "Nature's Bounty Fish Oil (Omega-3) 180 Capsules",
        "New Age Omega 3 Fish Oil 2500mg 90 Softgels",
        "Holland & Barrett Pure Cod Liver Oil 1000mg 240 Capsules",
        "Spring Valley Prenatal Multivitamin Multimineral For Pregnant Or Nursing Women 100 Tablets",
        "MuscleTech Test HD Elite, Tribulus Terrestris for Men, Max-Strength ATP & Test Booster for Men, Boost Free Testosterone Levels, 60 Veggie Capsules",
        "Centrum Advance 50+ Multivitamin Tablets",
        "Boots Omega 3 Fish Oil 1000mg 180 Capsules",
        "Multicap",
        "Centrum Silver Multivitamin For Adults 125 TabletsAdults+50",
        "Wascot",
        "Glutathione Supplement 2,000mg Per Serving, 240 Veggie Capsules",
        "One A Day Men’s 50+ Healthy Advantage Multivitamin, Multivitamin for Men with Vitamins A, C, E, B6, B12, Calcium and Vitamin D, Tablet, 200 Count",
        "Blackmores Fish Oil 1000mg 80 Capsules",
        "Puritan's Pride Ultra Women 50 Plus Daily Multi Performance Formula Targeted For Women Over 50",
        "One A Day Men’s Multivitamin, Supplement Tablet Immune Health Support, B12, Calcium & more, 200 count",
        "Himega",
        "Muscletech 100% Omega Fish Oil, 100 Ct",
        "Nature Made Fish Oil 1200mg 100 Capsules",
        "One A Day Multivitamin Mens & Womens Proactive 150 Tablets",
        "Centrum Silver Women's Multivitamin for Women 50 Plus, Multivitamin/Multimineral Supplement with Vitamin D3, B Vitamins, 200Tablets",
        "Smarty Pants Kids Formula Multivitamin Omega 3 Fish Oil Vitamin D3",
        "Himalaya Party Smart",
        "One A Day Womens 6 Key Vital Function 300 Tablets",
        "Himalaya Bresol",
        "Osteo Bi-Flex Triple Strength, 200 Tablets",
        "Optimum Nutrition Opti-Men, Vitamin C, Zinc and Vitamin D, E, B12 for Immune Support Mens Daily Multivitamin Supplement, 90 Count",
        "Vtas",
        "One A Day Men’s 50+ Multivitamins, Supplement with Vitamin A, Vitamin C, Vitamin D, Vitamin E and Zinc for Immune Health Support*, Calcium & more, Tablet 100 count",
        "Nutricost D-Ribose Powder",
        "Menopace Original Vitabiotics 30 Tablets",
        "Vitabiotics Pregnacare Original 30 Tablets",
        "Himalaya Septilin Syrup",
        "Guardian Kids Gummies Omega + Dha 60's",
        "Libifem1000mg",
        "VitaminStore Multivitamins Blackcurrant Flavour 20 Tablets",
        "Nature'S Bounty Horny Goat Weed With Maca - 60 Capsules",
        "Centrum Minis Women 50+ Multivitamins"
    ];

    // $products = App\Modules\ProductManagement\Product\Models\Model::whereIn('title',$titles)->count();
    // dd($products);

    foreach($titles as $title){
        $product = App\Modules\ProductManagement\Product\Models\Model::where('title',$title)->first();
        $categoryModel = App\Modules\ProductManagement\ProductCategory\Models\Model::class;
        if($product){
            $check = $product->product_categories()->where('slug',request()->slug)->first();
            if(!$check){
                $category =$categoryModel::where('slug',request()->slug)->first();
                if($category){
                    DB::table('product_category_products')->insert([
                        'product_id' => $product->id,
                        'product_category_id' => $category->id,
                        'product_category_group_id' => 1,
                    ]);
                    // dd($product->toArray());
                }
            }
            $product->is_shop_page_featured = 1;
            $product->save();
        }
    }
});

Route::get('up_price_amount', function () {
    $id = request()->si;
    $product = App\Modules\ProductManagement\Product\Models\Model::find($id);
    if ($product) {

        $varient = DB::table('product_medicine_varients')->where('product_id', $id)->first();
        $product->purchase_price = $varient->pv_purchase_price;
        $product->product_price = $varient->pv_mrp;
        $product->customer_sales_price = $varient->pv_mrp;
        $product->retailer_sales_price = $varient->pv_mrp;
        $product->minimum_sale_price = $varient->pv_mrp;
        $product->maximum_sale_price = $varient->pv_mrp;

        $product->profit_margin_percent = 100 - (100 * $varient->pv_purchase_price / $varient->pv_mrp);

        $pu_base_unit_label = $varient->pu_base_unit_label;

        $unit = App\Modules\ProductManagement\ProductUnit\Models\Model::where('title', $pu_base_unit_label)->first();
        if ($unit) {
            $product->product_unit_id = $unit->id;
        }

        $medicine_info = DB::table('product_medicines')->where('product_id', $id)->first();
        $p_form = $medicine_info->p_form;
        $p_strength = $medicine_info->p_strength;
        $p_manufacturer_id = $medicine_info->p_manufacturer_id;
        $p_generic_id = $medicine_info->p_generic_id;
        $p_brand_id = $medicine_info->p_brand_id;
        $p_meta_description = $medicine_info->p_meta_description;
        $p_description = $medicine_info->p_description;
        $is_antibiotics = $medicine_info->is_antibiotics;
        $p_form = $medicine_info->p_form;

        $product->medicine_weight = $p_strength;
        $product->is_antibiotic = $is_antibiotics;
        $product->medicine_type = $p_form;
        $product->product_menufecturer_id = $p_manufacturer_id;
        $product->product_brand_id = $p_brand_id;
        $product->product_medicine_generic_id = $p_generic_id;

        $product->description = $p_description;
        $product->meta_description = $p_meta_description;

        $product->save();

        return response()->json(1);
    }

    return "not ok";
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name', '.*');
    Route::get('/resize/cache/{file_name}', 'AssetController@cache_resize')->where('file_name', '.*');
});

require_once __DIR__ . '/ssl_route.php';
require_once __DIR__ . '/test_route.php';
