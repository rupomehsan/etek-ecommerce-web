<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class MedicineProductVerientModel extends EloquentModel
{


    protected $table = "product_medicine_varients";
    protected $guarded = [];
}
