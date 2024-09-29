<?php

namespace App\Modules\BlogManagement\Blog;

use Illuminate\Database\Eloquent\Model as EloquentModel;



class ViewModel extends EloquentModel
{
    protected $table = "blog_views";
    protected $guarded = [];
}
