<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    static $productCategoryModel = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    static $productCategoryGroupModel = \App\Modules\ProductManagement\ProductCategoryGroup\Models\Model::class;
    static $productBrandModel = \App\Modules\ProductManagement\ProductBrand\Models\Model::class;
    static $productImageModel = \App\Modules\ProductManagement\Product\Models\ProductImageModel::class;
    static $productVariantPriceModel = \App\Modules\ProductManagement\Product\Models\ProductVarientPriceModel::class;
    static $ProductRegionModel = \App\Modules\ProductManagement\Product\Models\ProductRegionModel::class;
    static $relatedCompareProductModel = \App\Modules\ProductManagement\Product\Models\RelatedCompareProductModel::class;
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $ProductReviewModel = \App\Modules\WebsiteApi\ProductReview\Models\Model::class;
    static $productCategoryBrandModel = \App\Modules\ProductManagement\Product\Models\ProductCategoryBrandModel::class;
    static $ProductReviewImageModel = \App\Modules\WebsiteApi\ProductReview\Models\ReviewImageModel::class;
    static $MedicineProductModel = \App\Modules\ProductManagement\Product\Models\MedicineProductModel::class;
    static $MedicineProductVerientModel = \App\Modules\ProductManagement\Product\Models\MedicineProductVerientModel::class;
    static $MedicineGenericModel = \App\Modules\ProductManagement\ProductGenerics\Models\Model::class;
    static $productUnitModel = \App\Modules\ProductManagement\ProductUnit\Models\Model::class;


    protected $table = "products";
    protected $guarded = [];
    protected $appends = [
        "b2b_discount_price",
        "b2c_discount_price",
        'current_price',
        'amount_in_percent',
        'is_discount',
        'average_rating',
        'total_views',
    ];
    protected $casts = [
        'specifications' => 'array'
    ];


    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            // $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
            // if (strlen($data->slug) > 150) {
            //     $data->slug = substr($data->slug, strlen($data->slug) - 150, strlen($data->slug));
            // }
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

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }

    public function product_categories()
    {
        return $this->belongsToMany(self::$productCategoryModel, 'product_category_products', 'product_id', 'product_category_id');
    }
    public function product_category_group_products()
    {
        return $this->belongsToMany(self::$productCategoryGroupModel, 'product_category_products', 'product_id', 'product_category_group_id',  'id');
    }
    public function product_brand()
    {
        return $this->belongsTo(self::$productBrandModel, 'product_brand_id');
    }

    public function product_image()
    {
        return $this->hasOne(self::$productImageModel, 'product_id', 'id');
    }

    public function product_images()
    {
        return $this->hasMany(self::$productImageModel, 'product_id', 'id');
    }

    public function product_verient_price()
    {
        return $this->hasMany(self::$productVariantPriceModel, 'product_id', 'id');
    }
    public function product_region()
    {
        return $this->hasMany(self::$ProductRegionModel, 'product_id', 'id');
    }
    public function product_reviews()
    {
        return $this->hasMany(self::$ProductReviewModel, 'product_id', 'id');
    }
    public function getTotalViewsAttribute()
    {
        return DB::table('product_view')->where('product_id', $this->id)->count();
    }
    public function medicine_product()
    {
        return $this->hasOne(self::$MedicineProductModel, 'product_id', 'id');
    }
    public function medicine_product_verient()
    {
        return $this->hasOne(self::$MedicineProductVerientModel, 'product_id', 'id');
    }
    public function medicine_generic()
    {
        return $this->belongsTo(self::$MedicineGenericModel, 'product_medicine_generic_id',  'id');
    }
    public function product_unit()
    {
        return $this->belongsTo(self::$productUnitModel, 'product_unit_id',  'id');
    }


    public function related_compare_products()
    {
        return $this->belongsToMany(
            self::$ProductModel,
            'related_compare_product',
            'product_id',
            'related_product_id'
        );
    }
    public function related_products()
    {
        return $this->belongsToMany(
            self::$ProductModel,
            'related_product',
            'product_id',
            'related_product_id'
        );
    }
    public function related_price_review()
    {
        return $this->belongsToMany(
            self::$ProductModel,
            'price_review_product',
            'product_id',
            'related_product_id'
        );
    }
    public function offer_products()
    {
        return $this->belongsToMany(
            self::$ProductModel,
            'product_offer_product',
            'product_id',
            'product_offer_id',
        );
    }


    public function product_varient_price()
    {
        return $this->hasMany(self::$productVariantPriceModel, 'product_id', 'id');
    }
    public function product_category_brands()
    {
        return $this->hasMany(self::$productCategoryBrandModel, 'product_brand_id');
    }
    /**
     * accessors.
     */


    public function getAverageRatingAttribute()
    {
        return $this->product_reviews()->avg('rating') ?? 0;
    }



    public function getCurrentPriceAttribute()
    {
        $price = $this->customer_sales_price;

        if ($this->discount_amount && $this->discount_type) {
            switch ($this->discount_type) {
                case 'percent':
                    $price -= ($this->customer_sales_price * ($this->discount_amount / 100));
                    break;
                case 'flat':
                    $price -= $this->discount_amount;
                    break;
            }
        }

        return $price;
    }


    public function getAmountInPercentAttribute()
    {
        if ($this->type == "product") {
            if (($this->discount_amount && $this->discount_type) && $this->discount_type != 'percent') {
                switch ($this->discount_type) {
                    case 'flat':
                        return ($this->discount_amount / $this->customer_sales_price) * 100;
                }
            }

            return 0;
        }
    }

    public function getIsDiscountAttribute()
    {
        // if ($this->discount_type == 'off') {
        if ($this->discount_amount || $this->medicine_product_verient?->pv_b2c_discount_percent || $this->medicine_product_verient?->pv_b2b_discount_percent) {
            return true;
        } else {
            return false;
        }
    }


    public function calculateDiscountPrice($salesPrice)
    {

        if (!$salesPrice) {
            return 0;
        }

        if ($this->discount_amount && $this->discount_type) {
            switch ($this->discount_type) {
                case 'percent':
                    return $salesPrice - ($salesPrice * ($this->discount_amount / 100));
                case 'flat':
                    return $salesPrice - $this->discount_amount;
            }
        }

        return $salesPrice ?? 0; // Return the original price if no discount is applicable
    }

    public function getB2bDiscountPriceAttribute()
    {
        return $this->calculateDiscountPrice($this->retailer_sales_price);
    }

    public function getB2cDiscountPriceAttribute()
    {
        return $this->calculateDiscountPrice($this->customer_sales_price);
    }
}
