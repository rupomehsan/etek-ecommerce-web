<?php

namespace App\Modules\WebsiteApi\Category\Actions;

class GetSingelCategory
{
    static $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $with = [];
            $fields = request()->input('fields') ?? ['*'];

            if (!$data = self::$model::query()->with($with)->select($fields)->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }

            $response = entityResponse($data);
            $response->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(5)->toRfc7231String());
            return $response;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
