<?php

namespace App\Modules\BlogManagement\Blog\Actions;


use App\Modules\BlogManagement\Blog\CommentValidation;
use Illuminate\Support\Facades\Storage;

class BlogComment
{
    static $model = \App\Modules\BlogManagement\Blog\Models\BlogCommentModel::class;
    static $blogModel = \App\Modules\BlogManagement\Blog\Models\Model::class;

    public static function execute(CommentValidation $request)
    {
        try {

            // dd($request->all());

            $requestData = $request->validated();
            $product = self::$blogModel::where('slug', $request->slug)->first();
            $requestData['blog_id'] = $product->id;
            if (self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
    }
}
