<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllNestedSubCategoryByCategoryId
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($slug)
    {
        try {
            // dd($slug);

            $data = self::$CategoryModel::where('slug', $slug)->select('id', 'title', 'slug', 'image', 'parent_id')->with([
                'all_childrens' => self::loadChildrenRecursively('all_childrens')
            ])->first();

            if (!$data) {
                return messageResponse('Data not found...', [], 404, 'error');
            }

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    public static function loadChildrenRecursively($relation)
    {
        return function ($query) use ($relation) {
            $query->select('id', 'title', 'slug', 'image', 'parent_id')
                ->with([
                    $relation => self::loadChildrenRecursively($relation)  // Recursive call
                ]);
        };
    }
}
