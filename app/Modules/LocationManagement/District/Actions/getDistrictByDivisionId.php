<?php

namespace App\Modules\LocationManagement\District\Actions;



class getDistrictByDivisionId
{
    static $model = \App\Modules\LocationManagement\District\Models\Model::class;

    public static function execute($division_id)
    {
        try {
            $orderByColumn = request()->input('sort_by_col');
            $orderByType = request()->input('sort_type');
            $status = request()->input('status');
            $fields = request()->input('fields');
            $with = [];
            $condition = [];

            $data = self::$model::query()->where('state_division_id',$division_id);
            $data = $data
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->orderBy($orderByColumn, $orderByType)
                ->get();
            
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}