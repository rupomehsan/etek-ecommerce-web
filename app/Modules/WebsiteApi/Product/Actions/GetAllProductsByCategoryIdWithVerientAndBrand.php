<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllProductsByCategoryIdWithVerientAndBrand
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $varient_value_id = null;
            $brand_id = null;
            $limit = request()->input('limit') ?? 10;
            if (request()->variant_values_id) {
                $varient_value_id = explode(',', request()->variant_values_id);
            }
            if (request()->brand_id) {
                $brand_id = explode(',', request()->brand_id);
            }

            $category = self::$CategoryModel::where('slug', $slug)
                ->with('parents:id,title,parent_id,slug,image,status')
                ->first();
            if (!$category) {
                return messageResponse('Data not found...', $slug, 404, 'error');
            }

            $products = $category->products()
                ->with('product_image');
            if ($varient_value_id) {
                $products->whereHas('product_verient_price', function ($q) use ($varient_value_id) {
                    if ($varient_value_id) {
                        $q->whereIn('product_varient_value_id', $varient_value_id);
                    }
                });
            }
            if ($brand_id) {
                $products->whereIn('product_brand_id', $brand_id);
            }

            $min_price = $products->clone()->orderBy('customer_sales_price', 'ASC')->where("customer_sales_price", ">", 0)->first()->customer_sales_price ?? 0;
            $max_price = $products->clone()->orderBy('customer_sales_price', 'DESC')->where("customer_sales_price", ">", 0)->first()->customer_sales_price ?? 0;

            if (request()->min && request()->max) {
                $products->whereBetween('customer_sales_price', [request()->min, request()->max])
                    ->orderBy("customer_sales_price", "ASC");
                // ->where("customer_sales_price", ">", 0);
            }


            $products = $products->paginate($limit);
            $advertise = $category->advertises()->where('status', 'active')->first();
            $childrens = $category->childrens()->get();

            $products->setPath("/category/" . $slug);

            return response()->json([
                "category" => $category,
                "products" => $products,
                "advertise" => $advertise,
                "childrens" => $childrens,
                "min_price" => $min_price,
                "max_price" => $max_price,
            ])->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(60)->toRfc7231String());
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
