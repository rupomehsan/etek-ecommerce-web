<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Modules\ProductManagement\Product\Models\Model as ProductModel;
use App\Modules\ProductManagement\ProductCategory\Models\Model as ProductCategoryModel;
use App\Modules\ProductManagement\ProductCategoryGroup\Models\Model as ProductCategoryGroupModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    public function home()
    {

        // $data = Cache::remember('home_page', (5 * 60), function () {
        $data =
            $hero_slider = \App\Modules\WebsiteApi\SliderAndBanner\Actions\HeroSlider::execute();
        // $hero_side_slider = \App\Modules\WebsiteApi\SliderAndBanner\Actions\HeroSliderSideBanner::execute();
        $left_nave_category = \App\Modules\WebsiteApi\Category\Actions\GetAllNavCategory::execute();
        $all_featured_categories = \App\Modules\WebsiteApi\Category\Actions\GetAllFeaturedCategory::execute(true, 20);
        $category_group = \App\Modules\WebsiteApi\Category\Actions\GetAllCategoryGroup::execute(true);
        $featured_products = \App\Modules\WebsiteApi\Product\Actions\GetAllFeaturedProduct::execute(true, 30);
        $heighlight_products = \App\Modules\WebsiteApi\Product\Actions\GetAllHeighlightProduct::execute(true, 10);
        $data = [
            'event' => [
                'title' => 'ETEK Enterprise - Leading Electronics and Gadgets',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh',
            ],
            'hero_slider' => $hero_slider->items(),
            'hero_side_slider' => $hero_side_slider ?? [],
            'left_nave_category' => $left_nave_category,
            'category_group' => $category_group,
            'all_featured_products' => $featured_products,
            'all_featured_categories' => $all_featured_categories,
            'heighlight_products' => $heighlight_products,
        ];



        //     return $data;
        // });

        return Inertia::render('Home/Index', $data);
    }

    public function mobile_search()
    {
        return Inertia::render('MobileSearch/Index', [
            'event' => [
                'title' => 'ETEK - Search',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function blogs()
    {
        return Inertia::render('Blogs/Index', [
            'event' => [
                'title' => 'ETEK - Blogs',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function blogDetails($slug)
    {

        return Inertia::render('Blogs/Details', [
            'slug' => $slug,
            'event' => [
                'title' => 'ETEK - Blog Details',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function shop($slug)
    {

        $data = Cache::remember('shop_' . $slug, (5 * 60), function () use ($slug) {
            $category_group = ProductCategoryGroupModel::where('slug', $slug)
                ->select('id', 'title', 'slug', 'image')
                ->first();

            $categories = ProductCategoryModel::where('product_category_group_id', $category_group->id)
                ->active()
                ->where('is_group_featured', 1)
                ->select('id', 'product_category_group_id', 'title', 'slug', 'image')
                ->limit(14)
                ->get();

            // $page_featured_categories = DB::select(
            //     "SELECT MIN(pcp.id) as id, pcp.product_category_id, pcp.product_category_group_id,
            //             pc.id as category_id, pc.title, pc.image, pc.is_shop_page_featured, pc.banner_image, pc.slug
            //     FROM product_category_products pcp
            //     JOIN product_categories pc ON pcp.product_category_id = pc.id
            //     WHERE pcp.product_category_group_id = $category_group->id
            //     AND pc.is_shop_page_featured = 1
            //     GROUP BY pcp.product_category_id, pc.id, pc.title, pc.image
            //     HAVING COUNT(pcp.id) > 15
            //     ORDER BY pcp.product_category_id ASC
            //     LIMIT 10"
            // );

            $page_featured_categories = DB::table('product_category_products as pcp')
                ->join('product_categories as pc', 'pcp.product_category_id', '=', 'pc.id')
                ->select(DB::raw('MIN(pcp.id) as id'), 'pcp.product_category_id', 'pcp.product_category_group_id', 'pc.id as category_id', 'pc.title', 'pc.image', 'pc.is_shop_page_featured', 'pc.banner_image', 'pc.slug')
                ->where('pcp.product_category_group_id', $category_group->id)
                ->where('pc.is_shop_page_featured', 1)
                ->groupBy('pcp.product_category_id', 'pcp.product_category_group_id', 'pc.id', 'pc.title', 'pc.image', 'pc.is_shop_page_featured', 'pc.banner_image', 'pc.slug')
                // ->having(DB::raw('COUNT(pcp.id)'), '>', 15)
                ->having(DB::raw('COUNT(pcp.id)'), '>', 1)
                ->orderBy('pcp.product_category_id', 'asc')
                ->limit(10)
                ->get();

            $page_featured_category_products = [];
            foreach ($page_featured_categories as $item) {
                $temp = [
                    "category" => $item,
                    "products" => [],
                ];

                $temp["products"] = ProductModel::select([
                    "id",
                    "title",
                    "retailer_sales_price",
                    "customer_sales_price",
                    "b2b_discount_price",
                    "b2c_discount_price",
                    "is_available",
                    "slug",
                ])
                    ->with('product_image:id,url,product_id')
                    ->where("customer_sales_price", ">", 0)
                    ->where("is_available", 1)
                    ->whereHas('product_categories', function ($category) use ($item) {
                        $category->where('product_category_id', $item->product_category_id);
                    })
                    ->limit(12)
                    ->get();
                $page_featured_category_products[] = $temp;
            }

            foreach ($categories as $cat) {
                if (!$cat->image) {
                    try {
                        $cat->image = $cat->products()->first()->product_image()->first()?->url;
                    } catch (\Throwable $th) {
                        $cat->image = "";
                    }
                    $cat->save();
                }
            }

            return [
                'page_slug' => $slug,
                'page_category_group' => $category_group,
                'page_categories' => $categories,
                'page_featured_category_products' => $page_featured_category_products,
            ];
        });

        return Inertia::render('Shop/Index', [
            'page_slug' => $slug,
            'page_category_group' => $data['page_category_group'],
            'page_categories' => $data['page_categories'],
            'page_featured_category_products' => $data['page_featured_category_products'],
            'event' => [
                'title' => 'ETEK - Shop',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function all_products()
    {
        $search_key = "";
        if (request()->has('search_key')) {
            $search_key = request()->get('search_key');
        }
        // $all_products = \App\Modules\WebsiteApi\Product\Actions\GetProducts::execute($search_key);

        // dd($data);
        return Inertia::render('Products/SearchResults', [
            'page_search_key' => $search_key,
            "page" => request()->page,
            'event' => [
                // 'all_products' => $all_products,
                'title' => 'ETEK - Products',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function products($slug)
    {
        // $category = DB::table('product_categories')->select('title', 'slug')->where('slug', $slug)->first();
        $data = \App\Modules\WebsiteApi\Product\Actions\GetAllProductsByCategoryIdWithVerientAndBrand::execute($slug);

        $page = request()->page ? request()->page : 1;
        return Inertia::render('Products/Index', [
            'slug' => $slug,
            'page' => $page,
            'data' => $data,
            'event' => [
                'title' => $category->title ?? 'ETEK - Products' . ' price in bangladesh',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function categoryProducts($slug)
    {
        $category = DB::table('product_categories')->select('title', 'slug')->where('slug', $slug)->first();
        $page = request()->page ? request()->page : 1;
        return Inertia::render('Category/ProductByCategory', [
            'slug' => $slug,
            'page' => $page,
            'event' => [
                'title' => $category->title ?? 'ETEK - Products' . ' price in bangladesh',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function brandProducts($slug)
    {
        return Inertia::render('Brand/ProductsByBrand', [
            'slug' => $slug,
            'event' => [
                'title' => $slug . ' price in bangladesh',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function category_group_products($slug)
    {
        $page = request()->page ? request()->page : 1;
        return Inertia::render('Products/CategoryGroupProduct', [
            'slug' => $slug,
            'event' => [
                'title' => 'ETEK - Products',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function products_details($slug)
    {
        // $product = ProductModel::where('slug', $slug)->first();
        $initial_data = \App\Modules\WebsiteApi\Product\Actions\GetInitialProductDetails::class;
        $product = $initial_data::execute($slug);
        return Inertia::render('ProductDetails/Index', [
            'slug' => $slug,
            'product' => $product,
            // 'product_details' => $product,
            'event' => [
                'title' => 'ETEK - Product Details',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function offer_products($slug)
    {
        // $product = ProductModel::where('slug', $slug)->first();
        return Inertia::render('Products/OfferProduct', [
            'slug' => $slug,
            // 'product_details' => $product,
            'event' => [
                'title' => 'ETEK - Product Details',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function cart()
    {
        return Inertia::render('Cart/Index', [
            'event' => [
                'title' => 'ETEK - Cart',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function checkout()
    {
        return Inertia::render('Checkout/Index', [
            'event' => [
                'title' => 'ETEK - Checkout',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function contact()
    {
        return Inertia::render('Contact/Index', [
            'event' => [
                'title' => 'ETEK - Contact Us',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function about()
    {
        return Inertia::render('About/Index', [
            'event' => [
                'title' => 'ETEK - About Us',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function terms_conditions()
    {
        return Inertia::render('TermsConditions/Index', [
            'event' => [
                'title' => 'ETEK - Terms & Conditions',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function returns_exchanges()
    {
        return Inertia::render('ReturnsExchanges/Index', [
            'event' => [
                'title' => 'ETEK - Returns & Exchanges',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function shipping_Delivery()
    {
        return Inertia::render('ShippingDelivery/Index', [
            'event' => [
                'title' => 'ETEK - Shipping & Delivery',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function invoice()
    {
        return Inertia::render('Profile/pages/Invoice', [
            'event' => [
                'title' => 'ETEK - Invoice',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
}
