<?php

namespace App\Modules\Ecommerce\Faq\Actions;

class Import
{
    static $model = \App\Modules\Ecommerce\Faq\Models\Model::class;

    public static function execute()
    {
        try {
            foreach (request()->data as $row) {
                 self::$model::create([
                    "question" => $row['question'],

                    "answer" => $row['answer'],

                ]);
            }
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}