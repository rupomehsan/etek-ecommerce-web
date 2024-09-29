<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetVarientsByCategoryId
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $ProductVariantModel = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;


    public static function execute($slug)
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = [];
            $condition = [];

            $Category = self::$CategoryModel::where('slug', $slug)->first();
            if (!$Category) {
                return messageResponse('Data not found...', $slug, 404, 'error');
            }

            $data = self::$ProductVariantModel::query()->whereExists(function ($query) use ($Category) {
                $query->select("*")
                    ->from('product_category_varient')
                    ->whereRaw('product_category_varient.product_varient_id = product_varients.id')
                    ->where('product_category_varient.product_category_id', $Category->id);
            });

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }

            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(30)->toRfc7231String());
            return $response;

        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
