<?php

namespace App\Modules\ProductManagement\ProductMenufacturer\Actions;

class Import
{
    static $model = \App\Modules\ProductManagement\ProductMenufacturer\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "title" => $row['title'],

                    "serial" => $row['serial'],

                    "image" => $row['image'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
