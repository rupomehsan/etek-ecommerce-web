<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use App\Modules\ProductManagement\Product\Models\Model as ProductModel;
use App\Modules\ProductManagement\Product\Models\MedicineProductVerientModel as MedicineProductVerientModel;

class MedicineProductModel extends EloquentModel
{
    protected $table = "product_medicines";
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    public function varient(){
        return $this->belongsTo(MedicineProductVerientModel::class, 'product_id', 'product_id');
    }
}
