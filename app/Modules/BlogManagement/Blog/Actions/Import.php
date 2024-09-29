<?php

namespace App\Modules\BlogManagement\Blog\Actions;

class Import
{
    static $model = \App\Modules\BlogManagement\Blog\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "description" => $row['description'],

                    "tags" => $row['tags'],

                    "public_date" => $row['public_date'],

                    "writer" => $row['writer'],

                    "meta_title" => $row['meta_title'],

                    "meta_description-100" => $row['meta_description-100'],

                    "meta_keywords" => $row['meta_keywords'],

                    "thumbnail_image" => $row['thumbnail_image'],

                    "image" => $row['image'],

                    "blog_type" => $row['blog_type'],

                    "video_url" => $row['video_url'],

                    "privecy_status" => $row['privecy_status'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}