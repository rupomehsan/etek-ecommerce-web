<?php

namespace App\Modules\Auth\Actions;


class CheckUser
{
    public static function execute()
    {
        try {
            if (auth()->check()) {
                $data = auth()->user()->load(['role', 'permissions','user_delivery_address']);
                return entityResponse($data);
            }
            return response()->json(["User not found"], 404);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
