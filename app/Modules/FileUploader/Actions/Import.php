<?php

namespace App\Modules\FileUploader\Actions;

class Import
{
    static $model = \App\Modules\FileUploader\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "product_id" => $row['product_id'],

                    "url" => $row['url'],

                    "caption" => $row['caption'],

                    "is_primary" => $row['is_primary'],

                    "is_secondary" => $row['is_secondary'],

                    "is_thumb" => $row['is_thumb'],

                    "alt" => $row['alt'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}