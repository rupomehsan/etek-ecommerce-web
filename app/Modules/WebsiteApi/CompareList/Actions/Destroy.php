<?php

namespace App\Modules\WebsiteApi\CompareList\Actions;

class Destroy
{
    static $model = \App\Modules\WebsiteApi\CompareList\Models\Model::class;

    public static function execute($id)
    {
        try {
            if (!$data=self::$model::where('id', $id)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $data->delete();
            return messageResponse('Item Successfully deleted',[], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
