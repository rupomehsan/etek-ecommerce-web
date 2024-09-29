<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetAllNestedGroupCategoryByGroupCategoryId
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $CategoryGroupModel = \App\Modules\ProductManagement\ProductCategoryGroup\Models\Model::class;

    public static function execute($slug)
    {
        try {
            // dd($slug);

            $categoryGroup = self::$CategoryGroupModel::where('slug', $slug)->first();
            if (!$categoryGroup) {
                return messageResponse('Data not found...', $slug, 404, 'error');
            }

            $data = self::$CategoryModel::where('product_category_group_id', $categoryGroup->id)->select('id', 'title', 'slug', 'image', 'parent_id')->with([
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
