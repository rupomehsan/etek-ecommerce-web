<?php

namespace App\Modules\ProductManagement\ProductBrand\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    protected $table = "product_brands";
    protected $guarded = [];
    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    // static $productCategoryBrandModel = \App\Modules\ProductManagement\Product\Models\ProductCategoryBrandModel::class;
    static $productCategoryBrandModel = \App\Modules\ProductManagement\Product\Models\ProductCategoryBrandModel::class;

    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
            if (strlen($data->slug) > 150) {
                $data->slug = substr($data->slug, strlen($data->slug) - 150, strlen($data->slug));
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
    }


    public function products()
    {
        return $this->hasMany(self::$productModel, 'product_brand_id');
    }

    public function product_category_brands()
    {
        return $this->hasMany(self::$productCategoryBrandModel, 'product_brand_id');
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }
}
