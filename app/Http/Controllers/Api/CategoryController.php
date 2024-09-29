<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ProductManagement\ProductCategory\Models\Model as Category;
use App\Modules\ProductManagement\ProductBrand\Models\Model as Brand;
use App\Modules\ProductManagement\ProductVarient\Models\Model as ProductVarient;
use App\Modules\ProductManagement\ProductVarientValue\Models\Model as ProductVarientValue;

class CategoryController extends Controller
{

    // public function all_categories()
    // {
    //     $data = Category::where('parent_id', 0)
    //         ->select([
    //             'id',
    //             'is_nav',
    //             'is_featured',
    //             'parent_id',
    //             'title',
    //             'serial',
    //             'image',
    //             'slug'
    //         ])
    //         ->where('status', 'active')
    //         ->orderBy('serial', 'ASC')
    //         ->get();
    //     return response()->json($data)->header('Cache-Control', 'public, max-age=300')
    //         ->header('Expires', now()->addMinutes(120)->toRfc7231String());
    // }

    // public function sub_categories($slug)
    // {
    //     $category = Category::where('slug', $slug)->first();

    //     $data = $category->childrens()->get();

    //     if ($data->count()) {
    //         $data->prepend($category);
    //         return response()->json($data)->header('Cache-Control', 'public, max-age=300')
    //             ->header('Expires', now()->addMinutes(120)->toRfc7231String());
    //     } else {
    //         return response()->json([$category])->header('Cache-Control', 'public, max-age=300')
    //             ->header('Expires', now()->addMinutes(120)->toRfc7231String());
    //     }
    // }




    // public function varients()
    // {
    //     $data = ProductVarient::select([
    //         'id',
    //         'title',
    //     ])->take(10)->get()->map(function ($i) {
    //         $i->values = ProductVarientValue::where('product_varient_id', $i->id)
    //             ->select('id', 'product_varient_id', 'title')->take(10)->get();
    //         return $i;
    //     });
    //     return response()->json($data)->header('Cache-Control', 'public, max-age=300')
    //         ->header('Expires', now()->addMinutes(120)->toRfc7231String());
    // }

    // public function category($slug)
    // {

    //     $varient_value_id = null;
    //     $brand_id = null;
    //     if (request()->variant_values_id) {
    //         $varient_value_id = explode(',', request()->variant_values_id);
    //     }
    //     if (request()->brand_id) {
    //         $brand_id = explode(',', request()->brand_id);
    //     }

    //     $category = Category::where('slug', $slug)
    //         ->with('parents:id,title,parent_id,slug,image,status')
    //         ->first();
    //      if (!$category) {
    //         return messageResponse('Data not found...', $slug, 404, 'error');
    //     }

    //     $products = $category->products()
    //         ->with('product_image');
    //     if ($varient_value_id) {
    //         $products->whereHas('product_verient_price', function ($q) use ($varient_value_id) {
    //             if ($varient_value_id) {
    //                 $q->whereIn('product_varient_value_id', $varient_value_id);
    //             }
    //         });
    //     }
    //     if ($brand_id) {
    //         $products->whereIn('product_brand_id', $brand_id);
    //     }

    //     $min_price = $products->clone()->orderBy('customer_sales_price', 'ASC')->where("customer_sales_price", ">", 0)->first()->customer_sales_price ?? 0;
    //     $max_price = $products->clone()->orderBy('customer_sales_price', 'DESC')->where("customer_sales_price", ">", 0)->first()->customer_sales_price ?? 0;

    //     if (request()->min && request()->max) {
    //         $products->whereBetween('customer_sales_price', [request()->min, request()->max])
    //             ->orderBy("customer_sales_price", "ASC");
    //         // ->where("customer_sales_price", ">", 0);
    //     }


    //     $products = $products->paginate(30);
    //     $advertise = $category->advertises()->where('status', 'active')->first();
    //     $childrens = $category->childrens()->get();

    //     $products->setPath("/category/" . $slug);

    //     return response()->json([
    //         "category" => $category,
    //         "products" => $products,
    //         "advertise" => $advertise,
    //         "childrens" => $childrens,
    //         "min_price" => $min_price,
    //         "max_price" => $max_price,
    //     ])->header('Cache-Control', 'public, max-age=300')
    //         ->header('Expires', now()->addMinutes(60)->toRfc7231String());

    // }
}
