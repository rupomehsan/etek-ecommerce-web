<?php

namespace App\Modules\Ecommerce\GeneralSeo\Actions;

class All
{
    static $model = \App\Modules\Ecommerce\GeneralSeo\Models\Model::class;

    public static function execute($request)
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'ASC';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? "*";
            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');
            $with = [];
            $condition = [];

            $data = self::$model::query();

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->where('title', $searchKey);
                    $q->orWhere('title', 'like', '%' . $searchKey . '%');
                    $q->orWhere('value', 'like', '%' . $searchKey . '%');
                });
            }


            if ($start_date && $end_date && $end_date > $start_date) {
                $data->where('created_at', '>=', $start_date);
                $data->where('created_at', '<=', $end_date);
            }


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
            return entityResponse([
                ...$data->toArray(),
                "active_data_count" => self::$model::active()->count(),
                "inactive_data_count" => self::$model::inactive()->count(),
            ]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
