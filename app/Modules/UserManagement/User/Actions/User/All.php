<?php

namespace App\Modules\UserManagement\User\Actions\User;

use App\Modules\UserManagement\User\Validations\GetAllValidation;

class All
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute(GetAllValidation $request)
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'ASC';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? ['id','name','email','phone_number', "status", 'slug', 'created_at'];
            $condition = [];

            $with = ['user_address', 'user_address.user_address_contact_person'];

            $data = self::$model::query()->select($fields);

            if (request()->has('with')) {
                $with = array_merge($with, request()->with);
            }

            if (request()->has('condition')) {
                $condition = array_merge($condition, request()->condition);
            }

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->where('name', $searchKey);
                    $q->orWhere('name', 'like', '%' . $searchKey . '%');
                });
            }

            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');
            if ($start_date && $end_date && $end_date > $start_date) {
                $data->where('created_at', '>=', $start_date);
                $data->where('created_at', '<=', $end_date);
            }

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data
                    ->with($with)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
            } else {
                $data = $data
                    ->with($with)
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
