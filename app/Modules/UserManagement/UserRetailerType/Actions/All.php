<?php

namespace App\Modules\UserManagement\UserRetailerType\Actions;

class All
{
    static $model = \App\Modules\UserManagement\UserRetailerType\Models\Model::class;

    public static function execute($request)
    {

        try {
            // dd(request()->all());
            $offset = request()->input('offset') ?? 10;
            $condition = [];
            $with = [];
            $fields = request()->input('fields') ?? ['id','name','email','phone_number', "status", 'slug', 'created_at'];
            $data = self::$model::query()->select($fields);
            
            // $data = self::$model::query();
            if (request()->has('status') && request()->input('status')) {
                $condition['status'] = request()->input('status');
            }

            if (request()->has('search') && request()->input('search')) {
                $data = $data->where('title', 'like', '%' . request()->input('search') . '%');
            }

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data->with($with)->where($condition)->latest()->get();
            } else {
                $data = $data->with($with)->where($condition)->latest()->paginate($offset);
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
