<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class ProductCategoryProductModel extends EloquentModel
{
    protected $table = "product_category_products";
    protected $guarded = [];
}