<?php

namespace App\Modules\ProductManagement\ProductVarientValue\Actions;

class BulkActions
{
    static $model = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;

    public static function execute()
    {
        try {
            if (request()->input('action') == 'active') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->update(['status' => 'active']);
                }
                return messageResponse("Items are activeted Successfully ");
            }
            if (request()->input('action') == 'inactive') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->update(['status' => 'inactive']);
                    return messageResponse("Items are inactiveted Successfully ");
                }
            }

            if (request()->input('action') == 'delete') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->delete();
                    return messageResponse("Items are deleted Successfully ");
                }
            }

            return messageResponse("Items are Successfully " . request()->input('action'), [],200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
