<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class ProductCategoryVarientModel extends EloquentModel
{


    protected $table = "product_category_varient";
    protected $guarded = [];

    static $productVariantModel = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;
    static $productVariantValueModel = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;


    public function productVarient()
    {
        return $this->belongsTo(self::$productVariantModel, 'product_varient_id');
    }

    // Define the relationship to ProductVarientValueModel
    public function productVarientValue()
    {
        return $this->belongsTo(self::$productVariantValueModel,  'product_varient_value_id');
    }
}
