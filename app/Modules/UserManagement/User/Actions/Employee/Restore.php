<?php

namespace App\Modules\UserManagement\User\Actions\Employee;

class Restore
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    public static function execute()
    {

        try {
            if (!$data = self::$model::where('slug', request()->slug)->first()) {
                return messageResponse('Data not found...',[], 404, 'error');
            }
            $data->status = 'active';
            $data->update();
            return messageResponse('Item Successfully Restored');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
