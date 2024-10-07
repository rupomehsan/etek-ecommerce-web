<?php

namespace App\Modules\LocationManagement\StateDivision\Actions;



class Show
{
    static $model = \App\Modules\LocationManagement\StateDivision\Models\Model::class;

    public static function execute($slug)
    {
        try {
            $with = [];
            $fields = request()->input('fields');
            if (!$data = self::$model::query()->with($with)->select($fields)->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}