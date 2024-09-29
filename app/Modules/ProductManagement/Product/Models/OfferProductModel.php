<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class OfferProductModel extends EloquentModel
{


    protected $table = "product_offer_product";
    protected $guarded = [];

    static $productImageModel = \App\Modules\ProductManagement\Product\Models\ProductImageModel::class;


    public function product_images()
    {
        return $this->hasMany(self::$productImageModel, 'product_id', 'id');
    }



}
