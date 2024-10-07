<?php

namespace App\Modules\WebsiteApi\Cart\Actions;
use App\Modules\ProductManagement\Product\Models\Model as ProductModel;
class All
{
    static $model = \App\Modules\WebsiteApi\Cart\Models\Model::class;

    public static function execute($all = false)
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type')    ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? [
                'id',
                'user_id',
                'product_id',
                'product_name',
                'quantity',
                'current_price',
            ];
            $with = [
                'product:id,slug,title,purchase_price,customer_sales_price,type,discount_type,discount_amount,b2b_discount_price, b2c_discount_price',
                'product.product_image:id,product_id,url'
            ];
            $condition = [];

            $data = self::$model::query()->where('user_id', auth()->user()->id);

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->where('title', $searchKey);
                    $q->orWhere('description', 'like', '%' . $searchKey . '%');
                });
            }

            if ( $all || (request()->has('get_all') && (int)request()->input('get_all') === 1) ) {
                $data = $data
                    // ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get()
                    ->map(function ($item) {
                        // if ($item->product->type == 'medicine') {
                        //     $item->product->load(['medicine_product', 'medicine_product_verient']);
                        // }
                        $product = ProductModel::find($item->product_id);
                        if($product){
                            $item->product_image = $product->product_image()->select('product_id','url')->first();
                            $item->current_price = $product->current_price;
                            $item->final_price = $product->final_price;
                        }
                        return $item;
                    });
            } else {
                $data = $data
                    ->with($with)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }
            return $data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
