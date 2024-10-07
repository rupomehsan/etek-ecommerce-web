<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

Route::get('/set-question', function () {
    return 0;
    DB::table('product_questions')->update(['is_approved' => 1]);
});

Route::get('/set-is-available', function () {
    return 0;
    $data =  DB::table('products')->where('purchase_price', 0)->update(['is_available' => 0]);
});
Route::get('/pget', function () {
    return 0;
    $data =  DB::table('products')->where('id', 184)->first();
    return $data;
});

Route::get('/fixed-discount-product', function () {
    return 0;
    $products = DB::table('products')->select('id', 'customer_sales_price', 'discount_amount')->get();

    foreach ($products as $product) {

        $new_discount_amount = ($product->customer_sales_price * 5 / 100);

        DB::table('products')
            ->where('id', $product->id)
            ->update(['discount_amount' => $new_discount_amount]);
    }
});

Route::get('/set-related-products', function () {
    return 0;
    DB::table('related_product')->truncate();
    for ($i = 1; $i <= 10; $i++) {
        DB::table('related_product')->insert([
            'product_id' => 1,
            'related_product_id' => $i + 1,
        ]);
    }
});
Route::get('/set-related-compare-products', function () {
    return 0;
    DB::table('related_compare_product')->truncate();
    for ($i = 1; $i <= 10; $i++) {
        DB::table('related_compare_product')->insert([
            'product_id' => 1,
            'related_product_id' => $i + 1,
        ]);
    }
});

Route::get('/set-related-price-review-products', function () {
    return 0;
    DB::table('price_review_product')->truncate();
    for ($i = 1; $i <= 10; $i++) {
        DB::table('price_review_product')->insert([
            'product_id' => 1,
            'related_product_id' => $i + 1,
        ]);
    }
});

Route::get('/update-category-group-id', function () {
    return 0;
    DB::table('product_category_products')->where('id', '>', '0')->update([
        'product_category_group_id' => 3,
    ]);
});

Route::get('/offer-product-create', function () {
    return 0;
    DB::table('product_offer_product')->truncate();
    for ($i = 1; $i <= 100; $i++) {
        DB::table('product_offer_product')->insert([
            'product_id' => $i,
            'product_offer_id' => rand(1, 4),
        ]);
    }
});


Route::get('/product-category-brands', function () {
    return 0;
    $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    DB::table('product_category_brand')->truncate();
    $category = $model::with('products')->first();

    if ($category) {
        foreach ($category->products as $item) {
            $product_brand = DB::table('product_category_brand')
                ->where('product_brand_id', $item->product_brand_id)->first();
            if (!$product_brand) {
                DB::table('product_category_brand')->insert([
                    'product_category_id' => $category->id,
                    'product_brand_id' => $item->product_brand_id,
                    // 'total_product' => $item->product_brand_id
                ]);

                $productsCount = $category->products()
                    ->where('products.product_brand_id', $item->product_brand_id)
                    // ->where('customer_sales_price', '>', '0')
                    ->count();
                DB::table('product_category_brand')
                    ->where('product_category_id', $category->id)
                    ->where('product_brand_id', $item->product_brand_id)
                    ->update([
                        'total_product' => $productsCount
                    ]);
            }
        }
    }
});


Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::view('cache-check', 'cache');
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name', '.*');
});

// Route::get("/about", function () {
//     return Inertia::render("About", [
//         'event' => [
//             'title' => 'About',
//             'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
//             'description' => 'My Website - Used Car inventory'
//         ]
//     ]);
// });

Route::get('/undefined', function () {
});
Route::get('/null', function () {
});
Route::get('/f', function () {
    // Storage::disk('project_upload')->putFileAs("ehsan", public_path("uploads/products/-CW-9060039-WW-Gallery-H100i-RGB-PLATINUM-01-228x228.png"), "new.png");
});
// Route::get('/role', function () {
//  dd(config('role.customer'));
// });

Route::get('update-category-brand', function () {
    return;
    ini_set('max_execution_time', 99999999999999);
    $category_brand = \App\Modules\ProductManagement\Product\Models\ProductCategoryBrandModel::class;
    $categoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    // $brands = \App\Modules\ProductManagement\ProductBrand\Models\Model::select('id', 'title')->get();

    $seleced_category = $categoryModel::where('slug', request()->slug)->first();

    if(!$seleced_category){
        return 0;
    }

    $products = $seleced_category->products()
        ->select([
            'products.id',
            'products.product_brand_id',
        ])->get();

    $products = $products->unique('product_brand_id');

    // dd($products->count());

    foreach ($products as $key => $product) {
        $check = $category_brand::where('product_category_id', $seleced_category->id)
            ->where('product_brand_id', $product->product_brand_id)
            ->first();

        $total_product = $seleced_category->products()
            ->select('id', 'product_brand_id')
            ->where('product_brand_id', $product->product_brand_id)
            ->count();

        if ($check) {
            $check->total_product = $total_product;
            $check->save();
        } else {
            $category_brand::insert([
                'product_category_id' => $seleced_category->id,
                'product_brand_id' => $product->product_brand_id,
                'total_product' => $total_product,
            ]);
        }
    }
});

Route::get('/cache_clear',function(){
    Cache::clear();
});

Route::get('/makeparent',function(){
    $categoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    $cats = $categoryModel::where('parent_id',0)->get();
    foreach ($cats as $item) {
        $s_cats = $item->all_childrens()->get()->toArray();
        $child_ids = collect($s_cats)->pluck('id');

        foreach ($child_ids as $cat_id) {
            $item = $categoryModel::where('id', $cat_id)->first();
            try {
                if(!$item->image){
                    $product = $item->products()->first();
                    $url = $product->product_image()->first()->url;
                    $item->image = $url;
                    $item->save();
                }
            } catch (\Throwable $th) {

                // $product = $item->products()->skip(1)->first();
                // $url = $product->product_image()->first()->url;
                // $item->image = $url;
                // $item->save();
                throw $th;
            }

            // dd($item);
        }
    }

    // dd($cats->toArray());
});

Route::get('/set-category-image',function(){
    $categoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    $category = $categoryModel::where('slug', request()->slug)->with('all_childrens')->first()->toArray();

    $child_ids = collect($category['all_childrens'])->pluck('id');

    foreach ($child_ids as $cat_id) {
        $item = $categoryModel::where('id', $cat_id)->first();
        try {
            $product = $item->products()->first();
            $url = $product->product_image()->first()->url;
            $item->image = $url;
            $item->save();
        } catch (\Throwable $th) {

            // $product = $item->products()->skip(1)->first();
            // $url = $product->product_image()->first()->url;
            // $item->image = $url;
            // $item->save();
            // throw $th;
        }

        // dd($item);
    }
})->name('route name');

Route::get('/reset-product', function () {
    if (request()->has('tpit')) {
        DB::table('product_categories')->truncate();
        DB::table('product_brands')->truncate();
        DB::table('product_category_groups')->truncate();
        DB::table('product_category_products')->truncate();
        DB::table('product_category_tags')->truncate();
        DB::table('product_category_varient')->truncate();
        DB::table('product_color_size_qtys')->truncate();
        DB::table('product_generics')->truncate();
        DB::table('product_images')->truncate();
        DB::table('product_medicine_forms')->truncate();
        DB::table('product_medicine_generics')->truncate();
        DB::table('product_medicine_varients')->truncate();
        DB::table('product_medicines')->truncate();
        DB::table('product_menufacturers')->truncate();
        DB::table('product_offer_product')->truncate();
        DB::table('product_offers')->truncate();
        DB::table('product_questions')->truncate();
        DB::table('product_unit_groups')->truncate();
        DB::table('product_units')->truncate();
        DB::table('product_varient_group_titles')->truncate();
        DB::table('product_varient_groups')->truncate();
        DB::table('product_varient_prices')->truncate();
        DB::table('product_varient_values')->truncate();
        DB::table('product_varients')->truncate();
        DB::table('products')->truncate();
    }
});
