<?php

namespace App\Modules\WebsiteApi\WishList\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    protected $table = "wish_lists";
    protected $guarded = [];

    static $productModel = \App\Modules\ProductManagement\Product\Models\Model::class;


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

    public function product()
    {
        return $this->belongsTo(self::$productModel, "product_id");
    }
}
