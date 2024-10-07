<?php

namespace App\Modules\WebsiteApi\Category\Actions;

use Illuminate\Support\Facades\Cache;

class GetAllSubCategoryByCategoryId
{
    static $CategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($slug)
    {
        try {
            // dd($slug);

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? [
                'id',
                'slug',
                'title',
                'image',
                'parent_id',
                'status',
            ];
            $with = [
                'all_childrens_selected' => function ($q) use ($fields) {
                    $q->select($fields);
                }
            ];
            $condition = [];

            $Category = self::$CategoryModel::where('slug', $slug)->first();
            if (!$Category) {
                return messageResponse('Data not found...', $slug, 404, 'error');
            }

            $data = self::$CategoryModel::query()->active()->where('parent_id', $Category->id);

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {

                function flattenAllChildrens(array $array, $CategoryModel)
                {
                    $result = [];
                    foreach ($array as $category) {
                        $temp = $category;
                        unset($temp['all_childrens_selected']);
                        $result[] = $temp;

                        try {
                            $check = $CategoryModel::find($category['id']);
                            if (!$check->image) {
                                $check->image = $check->products()->with('product_image')->first()->product_image->url;
                                $check->save();
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }

                        $all_childrens = $category['all_childrens_selected'];
                        if (count($all_childrens)) {
                            $result = array_merge($result, flattenAllChildrens($all_childrens, $CategoryModel));
                        }
                    }
                    return $result;
                }

                $data->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType);

                // $data =  $data->get();

                $data = Cache::remember(
                    'search_' . $slug,
                    (5 * 60),
                    function ()  use ($data,) {
                        return $data->get();
                    }
                );

                $data = flattenAllChildrens($data->toArray(), self::$CategoryModel);
                $group_data = collect($data)->groupBy('parent_id');
                $final_data = [];

                foreach ($group_data as $category_id => $categories) {
                    $index_category = collect($data)->first(function ($value, $key) use ($category_id) {
                        return $value['id'] == $category_id;
                    });

                    if ($index_category) {
                        $final_data[$index_category['title']] = [$index_category,  ...$categories];
                    }
                }

                $data = $final_data;
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }

            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(25)->toRfc7231String());
            return $response;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
