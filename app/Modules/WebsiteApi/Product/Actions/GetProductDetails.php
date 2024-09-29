<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetProductDetails
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($slug)
    {
        try {


            if (request()->has('initial') && request()->input('initial')) {
                return self::getProductInitialData(request(), $slug);
            }


            $with = [
                'product_images:id,product_id,url',
                'product_categories:id,title,slug',
                'product_brand:id,title',
                'product_region',
                'product_region.country',

                'related_compare_products',
                'related_compare_products.product_image:id,product_id,url',

                'related_products:id,title,customer_sales_price,slug',
                'related_products.product_image:id,product_id,url',

                'product_reviews',
                'product_reviews.user:id,name',
                'product_reviews.product_review_images:id,product_review_id,image',

                'product_varient_price.product_varient_group_title:id,title',
                'product_varient_price.product_varient_values:id,title',
            ];

            $fields = request()->input('fields') ?? ['*'];
            if (empty($fields)) {
                $fields = ['*'];
            }

            $data = self::$ProductModel::query()
                ->with($with)
                ->select($fields)
                ->where('slug', $slug)
                ->first();

            if (!$data) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }


            // Prepare related compare products data
            $relatedProductArray = self::prepareRelatedCompareProducts($data);

            // Prepare variant price data
            $variantPriceData = self::prepareVariantPriceData($data);

            $data->related_compare_products_filter = $relatedProductArray;
            $data->related_price_review = $data->related_price_review()->where('is_available', 1)->select('title', 'customer_sales_price')->get();
            $data->related_products = $data->related_products()->where('is_available', 1)->select('title', 'customer_sales_price', 'slug')->get();
            $data->product_varient_price = $variantPriceData;


            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    private static  function prepareRelatedCompareProducts($data)
    {
        $relatedProductArray = [];
        if (!empty($data->related_compare_products)) {
            $title = ['title'];
            $image = ['image'];
            $price = ['price'];
            $brand = ['brand'];
            $availability = ['availability'];
            $rating = ['rating'];
            $spacification = ['spacification'];
            $product_id = ['id'];

            foreach ($data->related_compare_products as $item) {
                $title[] = $item->title;
                $image[] = "<img src='/{$item->product_image->url}' alt='' width='100' height='100'>";
                $price[] = "<del>{$item->customer_sales_price}৳</del> {$item->current_price}৳";
                $brand[] = $item->product_brand->title;
                $availability[] = $item->is_available ? 'In Stock' : 'Out of Stock';
                $rating[] = $item->average_rating;
                $spacification[] = $item->short_description;
                $product_id[] = $item->id;
            }

            $relatedProductArray[] = $title;
            $relatedProductArray[] = $image;
            $relatedProductArray[] = $price;
            $relatedProductArray[] = $brand;
            $relatedProductArray[] = $availability;
            $relatedProductArray[] = $rating;
            $relatedProductArray[] = $spacification;
            $relatedProductArray[] = $product_id;
        }
        return $relatedProductArray;
    }

    private static  function prepareVariantPriceData($data)
    {
        $variantGroups = [];

        $variantPrices = $data->product_varient_price()->get()->unique('product_varient_id');

        foreach ($variantPrices as $variantPrice) {
            $groupTitle = $variantPrice->product_varient_group->title;
            $variantTitle = $variantPrice->product_varients->title;
            $variantValue = $variantPrice->product_varient_values->title;

            if (!isset($variantGroups[$groupTitle])) {
                $variantGroups[$groupTitle] = [];
            }

            if (!isset($variantGroups[$groupTitle][$variantTitle])) {
                $variantGroups[$groupTitle][$variantTitle] = [];
            }

            $variantGroups[$groupTitle][$variantTitle][] = $variantValue;
        }

        $result = [];
        foreach ($variantGroups as $groupTitle => $variants) {
            $result[] = [
                "group_title" => $groupTitle,
                "varients" => $variants
            ];
        }

        return $result;
    }


    public static function getProductInitialData($request, $slug)
    {
        try {


            $with = [
                // 'product_images' => function ($query) {
                //     $query->select('id', 'product_id', 'url')->skip(1);
                // },
                'product_image:id,product_id,url',
                'product_categories:id,title',
                'product_brand:id,title',
                'product_region',
                'product_region.country',
            ];


            $fields = request()->input('fields') ?? ['*'];
            if (empty($fields)) {
                $fields = ['*'];
            }

            $data = self::$ProductModel::query()
                ->with($with)
                ->select($fields)
                ->where('slug', $slug)
                ->first();

            $data->product_images = $data->product_images()->select('id', 'product_id', 'url')->skip(1)->take(10)->get();

            if (!$data) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }

            // dd($data);

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
