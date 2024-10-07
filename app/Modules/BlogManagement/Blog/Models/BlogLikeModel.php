<?php

namespace App\Modules\BlogManagement\Blog\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;



class BlogLikeModel extends EloquentModel
{
    protected $table = "blog_likes";
    protected $guarded = [];
}
