<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllCategoryParent
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute()
    {
        try {
            $data = self::$CategoryModel::query()->whereIn('parent_id', [0, null])->get();
            return $data;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
