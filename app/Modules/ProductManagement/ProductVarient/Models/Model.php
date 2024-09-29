<?php

namespace App\Modules\ProductManagement\ProductVarient\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    static $ProductVerientGroupModel = \App\Modules\ProductManagement\ProductVarientGroup\Models\Model::class;

    protected $table = "product_varients";
    protected $guarded = [];

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

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function product_varient_group()
    {
        return $this->belongsTo(self::$ProductVerientGroupModel, 'product_varient_group_id');
    }

    public function values(){
        return $this->hasMany(\App\Modules\ProductManagement\ProductVarientValue\Models\Model::class,'product_varient_id');
    }

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }
}
