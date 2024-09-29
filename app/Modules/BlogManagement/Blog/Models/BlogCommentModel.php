<?php

namespace App\Modules\BlogManagement\Blog\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;


class BlogCommentModel extends EloquentModel
{
    protected $table = "blog_comments";
    protected $guarded = [];
}
