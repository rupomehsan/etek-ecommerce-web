<?php

namespace App\Modules\WebsiteApi\Blog;

use App\Modules\WebsiteApi\Blog\Actions\GetAllBlogs;
use App\Modules\WebsiteApi\Blog\Actions\GetSingleBlog;

use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function GetAllBlogs()
    {
        $data = GetAllBlogs::execute();
        return $data;
    }
    public function GetSingleBlog($slug)
    {
        $data = GetSingleBlog::execute($slug);
        return $data;
    }
}
