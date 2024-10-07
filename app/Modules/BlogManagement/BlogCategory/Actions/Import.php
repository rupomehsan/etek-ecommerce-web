<?php

namespace App\Modules\BlogManagement\BlogCategory\Actions;

class Import
{
    static $model = \App\Modules\BlogManagement\BlogCategory\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "parent_id" => $row['parent_id'],

                    "image" => $row['image'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}