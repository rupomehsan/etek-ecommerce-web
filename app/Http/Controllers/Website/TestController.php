<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ProductManagement\ProductVarient\Models\Model as ProductVarient;
use App\Modules\ProductManagement\ProductVarientValue\Models\Model as ProductVarientValue;
use App\Modules\ProductManagement\ProductCategory\Models\Model as ProductCategory;
use App\Modules\ProductManagement\Product\Models\Model as ProductModel;
use App\Modules\ProductManagement\ProductBrand\Models\Model as ProductBrand;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function uploads_variant()
    {
        $varients = [
            "size" => ['xs', 'sm', 'md', 'lg', 'xl', 'xxl', 'xxxl', '4xl', '5xl', '6xl'],
            "material" => ['cotton', 'polyester', 'wool', 'silk', 'linen'],
            "pattern" => ['solid', 'striped', 'checked', 'printed', 'dotted'],
            "brand" => ['brandA', 'brandB', 'brandC', 'brandD', 'brandE'],
            "color" => ['black', 'white', 'silver', 'gold', 'blue', 'red', 'green', 'purple', 'gray', 'pink'],
            "storage" => ['64GB', '128GB', '256GB', '512GB', '1TB', '2TB'],
            "screen_size" => ['5.5"', '6.1"', '6.5"', '6.7"', '7"', '7.5"', '8"', '10"', '12"', '13.3"', '15.6"', '17.3"'],
            "battery" => ['3000mAh', '4000mAh', '4500mAh', '5000mAh', '6000mAh'],
            "resolution" => ['720p', '1080p', '1440p', '4K', '8K'],
            "os" => ['Android', 'iOS', 'Windows', 'MacOS', 'Linux'],
        ];

        ProductVarient::truncate();
        ProductVarientValue::truncate();
        foreach ($varients as $key => $values) {
            $varient = ProductVarient::create([
                "title" => $key,
            ]);
            foreach ($values as $value) {
                $varient_value = ProductVarientValue::create([
                    "title" => $value,
                    "product_varient_id" => $varient->id,
                ]);
            }
        }
    }

    public function attach_category_into_products()
    {
        // DB::table('product_category_products')->truncate();
        function make_data($j, $limit)
        {
            $data = [];
            for ($i = $limit; $i < $limit + 20; $i++) {
                array_push($data, [
                    "product_category_id" => $j,
                    "product_id" => $i
                ]);
            }
            DB::table('product_category_products')->insert($data);
        };

        for ($i = 1; $i <= 15; $i += 4) {
            make_data($i, 1);
            make_data($i + 2, 10);
            make_data($i + 3, 20);
            make_data($i + 4, 30);
        }
    }

    public function product_and_category_upload()
    {
        function listAllPaths($directory)
        {
            $paths = [];

            // Check if the directory exists
            if (!is_dir($directory)) {
                return $paths; // Return empty array if directory does not exist
            }

            // Create a Recursive Directory Iterator
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            // Loop through each file and directory in the iterator
            foreach ($iterator as $fileInfo) {
                // Only include directories
                if ($fileInfo->isDir()) {
                    $paths[] = $fileInfo->getPathname();
                }
            }

            return $paths;
        };

        // Usage example
        $directory = public_path('product_source');
        $paths = listAllPaths($directory);

        return response()->json($paths);
    }

    public function upload_categories()
    {
        $categoreis = file_get_contents(public_path("product_categories/categories.json"));
        $categoreis = json_decode($categoreis);

        ProductCategory::truncate();

        foreach ($categoreis as $si => $category) {
            $cat_list = explode("\\", $category);
            foreach ($cat_list as $key => $cat) {
                $check = ProductCategory::where('title', $cat)->first();
                if (!$check) {
                    $parent_id = 0;
                    if ($key > 0) {
                        $parent_id = $cat_list[$key - 1]->id;
                    }
                    $new_cat = ProductCategory::create([
                        "title" => $cat,
                        "parent_id" => $parent_id,
                        "product_category_group_id" => 3,
                        "serial" => 9999999,

                        "meta_title" => $cat,
                        "meta_description" => $cat,
                        "meta_keywords" => $cat,
                        "search_keywords" => $cat,

                        "slug" => Str::slug($cat),
                    ]);

                    $cat_list[$key] = $new_cat;
                } else {
                    $cat_list[$key] = $check;
                }
            }

            // if ($si > 21) {
            //     break;
            // }
        }
        // dd($categoreis);
    }

    public function set_category_image()
    {
        $categories = ProductCategory::get();
        foreach ($categories as $category) {
            $total = $category->products()->count();
            if ($total) {
                $product = $category->products()->skip(rand(1, $total - 1))->first();
                if ($product) {
                    $category->image = $product->product_image()->first()->url;
                }
                $category->save();
            }
        }
    }

    public function set_nav_category()
    {
        $in = [
            'Desktop',
            'Laptop',
            'Component',
            'Monitor',
            'UPS',
            'Phone',
            'Tablet',
            'Office Equipment',
            'Camera',
            'Security',
            'Networking',
            'Software',
            'Gadget',
            'Gaming',
            'TV',
            'Appliance',
        ];
        ProductCategory::whereIn('title', $in)->update(['is_nav' => 1]);
        ProductCategory::whereNotIn('title', $in)->update(['is_nav' => 0]);
    }

    public function upload_product_list()
    {
        function listJsonFiles($directory)
        {
            // Initialize an array to hold the JSON file paths
            $jsonFiles = [];

            // Check if the directory exists
            if (!is_dir($directory)) {
                return $jsonFiles; // Return empty array if directory does not exist
            }

            // Create a Recursive Directory Iterator
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            // Loop through each file and directory in the iterator
            foreach ($iterator as $fileInfo) {
                // Only include JSON files
                if ($fileInfo->isFile() && $fileInfo->getExtension() === 'json') {
                    $jsonFiles[] = $fileInfo->getPathname();
                }
            }

            return $jsonFiles;
        }

        // Usage example
        $directory = public_path("product_source");
        $jsonFiles = listJsonFiles($directory);
        return response()->json($jsonFiles);
    }

    public function upload_product()
    {
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        function getImageNameFromURL($url)
        {
            $parts = explode('/', $url);
            $imageName = end($parts);
            return $imageName;
        }

        $products_json = file_get_contents(public_path("product_categories/products.json"));
        $products_json = json_decode($products_json);

        // ProductModel::truncate();
        // DB::table('product_images')->truncate();
        // DB::table('product_category_products')->truncate();

        foreach ($products_json as $si => $product_list_json) {
            $products = file_get_contents(public_path($product_list_json));
            $products = json_decode($products);

            $cat_titles = explode("/", $product_list_json);
            array_pop($cat_titles);
            array_shift($cat_titles);

            $cat_ids = [];

            foreach ($cat_titles as $cat_title) {
                $cat_info = ProductCategory::where('title', $cat_title)->first();
                if (!$cat_info) {
                    $cat_info = ProductCategory::create([
                        'title' => $cat_title,
                    ]);
                }
                $cat_ids[] = $cat_info->id;
            }

            foreach ($products as $product) {
                $product_info = ProductModel::where('title', $product->title)->first();

                if (!$product_info) {

                    $image = file_get_contents($product->img);
                    $image_name = getImageNameFromURL($product->img);
                    file_put_contents(public_path('uploads/products/' . $image_name), $image);

                    $short_description = "<ul>";
                    if (isset($product->product_page_short_description)) {
                        foreach ($product->product_page_short_description as $item) {
                            $short_description .= "<li>$item</li>";
                        }
                    }
                    $short_description .= "</ul>";

                    $brand = null;
                    if (isset($product->brand)) {
                        $brand = ProductBrand::where('title', $product->brand)->first();
                        if (!$brand) {
                            $brand = ProductBrand::create([
                                'title' => $product->brand
                            ]);
                        }
                    }

                    $regularPrice = $product->price_single ? $product->price_single : 0;

                    try {
                        $product_info = ProductModel::create([
                            'product_category_group_id' => 1,
                            'title' => $product->title,
                            'type' => "product",

                            'short_description' => $short_description,
                            'description' => $product->full_description ?? '',
                            'specification' => isset($product->specifications) ? json_encode($product->specifications) : "[]",

                            'product_menufecturer_id' => rand(1, 5),
                            'product_brand_id' => $brand->id ?? null,
                            'sku' => $product->code ?? null,
                            'product_unit_id' => rand(1, 5),
                            'alert_quantity' => 10,
                            'seller_points' => rand(2, 5),
                            'is_returnable' => rand(0, 1),
                            'expiration_days' => Carbon::now()->addMonths(30)->toDateString(),
                            // 'purchase_account' => facker()->name,

                            'discount_type' => "flat",
                            'discount_amount' => $product->price_new,

                            'price_type' => "single",

                            'purchase_price' => $regularPrice > 0 ? $regularPrice - 30 : 0,

                            'customer_sales_price' => $regularPrice > 0 ? $regularPrice : 0,
                            'retailer_sales_price' => $regularPrice > 0 ? $regularPrice - 5 : 0,
                            'minimum_sale_price' => $regularPrice > 0 ? $regularPrice - 10 : 0,
                            'maximum_sale_price' => $regularPrice > 0 ? $regularPrice + 20 : 0,

                            'tax_type' => ['inclusive', 'exclusive'][rand(0, 1)],
                            'tax_amount' => .5,
                            'is_featured' => rand(0, 1),

                            'meta_title' => $product->product_seo_title ?? null,
                            'meta_description' => $product->product_seo_description ?? null,
                            'meta_keywords' => $product->product_seo_keywords ?? null,
                            'search_keywords' => ($product->product_seo_keywords ?? '') . ' ' . $product->title . ' ' . ($product->product_seo_title ?? ''),

                            'slug' => Str::slug($product->title),
                        ]);
                    } catch (\Throwable $th) {
                        dd($regularPrice, $product, $th->getMessage());
                    }

                    $product_info->product_images()->create([
                        'url' => 'uploads/products/' . $image_name,
                        'caption' => $product->title,
                        'alt' => $product->title,
                        'is_primary' => 1,
                        'is_secondary' => 0,
                        'is_thumb' => 1,
                    ]);


                    $product_info->product_categories()->attach($cat_ids);

                    $category_varients = [];
                    $product_varients = [];

                    if (isset($product->specifications)) {
                        foreach ($product->specifications as $specifications) {
                            foreach ($specifications->values as $varient) {

                                if (isset($varient->key) && isset($varient->value)) {
                                    try {
                                        $check_varient = ProductVarient::where('title', $varient->key)->first();
                                        $check_varient_value = ProductVarientValue::where('title', $varient->value)->first();
                                        if (!$check_varient) {
                                            $check_varient = ProductVarient::create([
                                                "product_varient_group_id" => 2,
                                                "title" => $varient->key,
                                                "varient_type" => 'text',
                                            ]);
                                        }
                                        if (!$check_varient_value) {
                                            $check_varient_value = ProductVarientValue::create([
                                                "product_varient_group_id" => 2,
                                                "product_varient_id" => $check_varient->id,
                                                "title" => $varient->value,
                                            ]);
                                        }

                                        $category_varients[] = [
                                            "product_category_id" => null,
                                            "product_varient_group_id" => 2,
                                            "product_varient_id" => $check_varient->id,
                                            "product_varient_value_id" => $check_varient_value->id,
                                            "total_product" => 0,
                                        ];

                                        $product_varients[] = [
                                            "product_id" => $product_info->id,
                                            "product_varient_group_id" => 2,
                                            "product_varient_id" => $check_varient->id,
                                            "product_varient_value_id" => $check_varient_value->id,
                                            "varient_title" => $check_varient->title,
                                        ];
                                    } catch (\Throwable $th) {
                                        dd($varient);
                                    }
                                }
                            }
                        }
                        DB::table('product_varient_prices')->insert($product_varients);
                        foreach ($cat_ids as $cat_id) {
                            foreach ($category_varients as $key => $category_varient) {
                                $category_varients[$key]['product_category_id'] = $cat_id;
                                $category_varients[$key]['total_product'] = DB::table('product_varient_prices')
                                    ->where('product_varient_value_id', $category_varient['product_varient_value_id'])
                                    ->count();
                            }
                        }
                        DB::table('product_category_varient')->insert($category_varients);
                    }

                    if (isset($product->images)) {
                        foreach ($product->images as $p_image) {
                            try {
                                $image = file_get_contents($p_image);
                            } catch (\Throwable $th) {
                                redirect('/upload_product#context-app-routing');
                            }
                            $image_name = getImageNameFromURL($p_image);
                            file_put_contents(public_path('uploads/products/' . $image_name), $image);

                            $product_info->product_images()->create([
                                'url' => 'uploads/products/' . $image_name,
                                'caption' => $product->title,
                                'alt' => $product->title,
                                'is_primary' => 0,
                                'is_secondary' => 1,
                                'is_thumb' => 0,
                            ]);
                        }
                    }

                }
                // dd($product, $product_info, $category_varients, $product_varients);
            }
            // dd($products);
        }
        // dd($categoreis);
    }
}
