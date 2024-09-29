<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class ProductRegionModel extends EloquentModel
{


    protected $table = "product_regions";
    protected $guarded = [];

    static $CountryModel = \App\Modules\LocationManagement\Country\Models\Model::class;

    public function country()
    {
        return $this->hasOne(self::$CountryModel, 'id', 'country_id');
    }

}
