<?php

namespace App\Modules\BlogManagement\Blog\Actions;



class BlogLike
{
    static $model = \App\Modules\BlogManagement\Blog\Models\BlogLikeModel::class;


    public static function execute()
    {
        try {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['expiration']) && $_SESSION['expiration'] < time()) {
                session_unset();
                session_destroy();
            }

            $sessionId = $_SESSION['sessionId'] ?? session_id();
            $expiration = time() + 3600;
            $_SESSION['expiration'] = $expiration;
            $_SESSION['sessionId'] = $sessionId;
            $data = [
                'session_id' => $sessionId,
                'blog_id' => request()->id,
                'ip' => request()->ip(),
            ];
            $sessionIdIsExist = self::$model::query()
                ->where('session_id', $sessionId)
                ->where('blog_id', request()->id)
                ->exists();

            if ($sessionIdIsExist) {
                return messageResponse('Already liked');
            }
            if (self::$model::query()->create($data)) {
                return messageResponse('Thanks for like', 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
        
    }
}
