<?php

namespace App\Modules\AccountAndPayments\Accounts\Actions;

class Destroy
{
    static $model = \App\Modules\AccountAndPayments\Accounts\Models\Model::class;

    public static function execute()
    {
        try {
            if (!$data=self::$model::where('slug', request()->slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $data->delete();
            return messageResponse('Item Successfully deleted',[], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
