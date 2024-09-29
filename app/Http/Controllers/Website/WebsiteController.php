<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\modules\ProductManagement\Product\Models\Model as ProductModel;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function home()
    {
        $hero_slider = \App\Modules\WebsiteApi\SliderAndBanner\Actions\HeroSlider::execute();
        $hero_side_slider = \App\Modules\WebsiteApi\SliderAndBanner\Actions\HeroSliderSideBanner::execute();
        $left_nave_category = \App\Modules\WebsiteApi\Category\Actions\GetAllNavCategory::execute();

        return Inertia::render('Home/Index', [
            'event' => [
                'title' => 'ETEK Enterprise - Leading Electronics and Gadgets',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh',
            ],
            'hero_slider' => $hero_slider->items(),
            'hero_side_slider' => $hero_side_slider,
            'left_nave_category' => $left_nave_category,
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

    public function products($slug)
    {

        $category = DB::table('product_categories')->select('title', 'slug')->where('slug', $slug)->first();
        $page = request()->page ? request()->page : 1;
        return Inertia::render('Products/Index', [
            'slug' => $slug,
            'page' => $page,
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
        DB::table('product_view')->insert(['product_id' => $product->id]);
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
    public function privacy_policy()
    {
        return Inertia::render('PrivacyPolicy/Index', [
            'event' => [
                'title' => 'ETEK - Privacy Policy',
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

    public function search_results()
    {
        return Inertia::render('GlobalSearchResult/Index', [
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
