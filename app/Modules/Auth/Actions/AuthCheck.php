<?php

namespace App\Modules\Auth\Actions;


class AuthCheck
{
    public static function execute()
    {
        try {
            if (auth()->check()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
