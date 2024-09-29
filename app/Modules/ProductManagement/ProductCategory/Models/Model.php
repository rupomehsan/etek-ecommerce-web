<?php

namespace App\Modules\ProductManagement\ProductCategory\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Models\Model as AdvertiseModel;
use App\Modules\ProductManagement\ProductCategoryGroup\Models\Model as ProductCategoryGroup;

class Model extends EloquentModel
{
    protected $table = "product_categories";
    protected $guarded = [];
    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;
        protected $appends = ['is_subcategory_exist'];
  

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
        return $this->belongsToMany(self::$productModel,'product_category_products',
            'product_category_id', 'product_id');
    }

    public function parent()
    {
        return $this->belongsTo(Model::class, 'parent_id');
    }
    public function parents()
    {
        return $this->belongsTo(Model::class, 'parent_id')->with('parents')->select('id','title','parent_id','slug','status','image');
    }
    public function getIsSubcategoryExistAttribute(){
         return $this->childrens()->count();
    }

    public function group()
    {
        return $this->belongsTo(ProductCategoryGroup::class, 'product_category_group_id');
    }

    public function childrens()
    {
        return $this->hasMany(Model::class, 'parent_id');
    }

    public function all_childrens()
    {
        return $this->hasMany(Model::class, 'parent_id')->with('all_childrens');
    }

    public function advertises()
    {
        return $this->hasMany(AdvertiseModel::class, 'product_category_id');
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
