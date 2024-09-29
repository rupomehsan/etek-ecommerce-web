<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class ProductVarientPriceModel extends EloquentModel
{


    protected $table = "product_varient_prices";
    protected $guarded = [];

    static $ProductVariantGroupModel = \App\Modules\ProductManagement\ProductVarientGroup\Models\Model::class;
    static $ProductVariantModel = \App\Modules\ProductManagement\ProductVarient\Models\Model::class;
    static $ProductVariantValueModel = \App\Modules\ProductManagement\ProductVarientValue\Models\Model::class;
    static $ProductVariantGroupTitleModel = \App\Modules\ProductManagement\ProductVarientGroupTitle\Models\Model::class;


    public function product_varient_group()
    {
        return $this->belongsTo(self::$ProductVariantGroupModel, 'product_varient_group_id');
    }
    public function product_varient_group_title()
    {
        return $this->belongsTo(self::$ProductVariantGroupTitleModel, 'product_varient_group_title_id');
    }
    public function product_varients()
    {
        return $this->belongsTo(self::$ProductVariantModel, 'product_varient_id');
    }
    public function product_varient_values()
    {
        return $this->belongsTo(self::$ProductVariantValueModel, 'product_varient_value_id');
    }
}
