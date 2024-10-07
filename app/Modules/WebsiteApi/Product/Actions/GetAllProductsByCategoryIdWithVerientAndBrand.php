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
            $priceOrderByType = "ASC";
            $is_available = 1;
            $paginate = 30;

            if(request()->priceOrderByType){
                $priceOrderByType = request()->priceOrderByType;
            }

            if(request()->paginate){
                $paginate = request()->paginate;
            }

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
                ->with('product_image')
                ->where('is_available', $is_available);

            /** filter varitents */
            if ($varient_value_id) {
                $products->whereHas('product_verient_price', function ($q) use ($varient_value_id) {
                    if ($varient_value_id) {
                        $q->whereIn('product_varient_value_id', $varient_value_id);
                    }
                });
            }

            /** filter brand */
            if ($brand_id) {
                $products->whereIn('product_brand_id', $brand_id);
            }

            /** get min and max price */
            $min_price = $products->clone()->orderBy('customer_sales_price', 'ASC')->where("customer_sales_price", ">", 0)->first()->customer_sales_price ?? 0;
            $max_price = $products->clone()->orderBy('customer_sales_price', 'DESC')->where("customer_sales_price", ">", 0)->first()->customer_sales_price ?? 0;

            /** filter between min and max price */
            if (request()->min && request()->max) {
                $products->whereBetween('customer_sales_price', [request()->min, request()->max])
                    ->orderBy("customer_sales_price", $priceOrderByType)
                    ->where("customer_sales_price", ">", 0);
            } else {
                $products->orderBy("customer_sales_price", $priceOrderByType)
                    ->where("customer_sales_price", ">", 0);
            }

            /** return data */
            $products = $products->paginate($paginate);
            $advertise = $category->advertises()->where('status', 'active')->get();
            $childrens = $category->childrens()->select('id', 'title', 'slug')->get();

            $products->setPath("/products/" . $slug);

            return [
                "category" => $category,
                "products" => $products,
                "advertise" => $advertise,
                "childrens" => $childrens,
                "min_price" => $min_price,
                "max_price" => $max_price,
            ];
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
