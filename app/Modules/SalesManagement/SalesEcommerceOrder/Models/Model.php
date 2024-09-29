<?php

namespace App\Modules\SalesManagement\SalesEcommerceOrder\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
{

    static $OrderProductModel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderProductModel::class;
    static $userAddressModel = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userModel = \App\Modules\UserManagement\User\Models\Model::class;


    protected $table = "sales_ecommerce_orders";
    protected $guarded = [];
    protected $casts = [
        'delivery_address_details' => 'json',
    ];

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

    public function order_products()
    {
        return $this->hasMany(self::$OrderProductModel, 'sales_ecommerce_order_id', 'id');
    }
    public function order_delivery_address()
    {
        return $this->belongsTo(self::$userAddressModel, 'delivery_address_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(self::$userModel, 'user_id', 'id');
    }
}
