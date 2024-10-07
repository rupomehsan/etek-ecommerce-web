<?php

namespace App\Modules\ProductManagement\Product\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use \App\Modules\ProductManagement\ProductCategory\Models\Model as ProductModel;
use \App\Modules\ProductManagement\Product\Models\ProductMedicineGenericModel;
use \App\Modules\ProductManagement\ProductUnit\Models\Model as ProductUnitModel;
use \App\Modules\ProductManagement\ProductMenufacturer\Models\Model as ProductManufacturerModel;

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

    protected $table = "products";
    protected $guarded = [];
    protected $appends = [
        'current_price',
        'current_discount_price',
        'final_price',
        'total_views',
        'product_id',
    ];
    protected $casts = [
        'specifications' => 'array',
    ];

    protected $hidden = [
        'customer_sales_price',
        'retailer_sales_price',
        'b2b_discount_price',
        'b2c_discount_price',
    ];

    protected static function booted()
    {
        static::created(function ($data) {
            if (!$data->slug) {
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
            }
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

    public function product_category_many_though()
    {
        return $this->hasOneThrough(self::$productCategoryModel, ProductCategoryProductModel::class, 'product_category_id', 'id', 'id', 'product_id');
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
            'product_offer_id'
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
    public function product_generic()
    {
        return $this->belongsTo(ProductMedicineGenericModel::class, 'product_medicine_generic_id');
    }
    public function product_unit()
    {
        return $this->belongsTo(ProductUnitModel::class, 'product_unit_id');
    }
    public function product_manufaturer()
    {
        return $this->belongsTo(ProductManufacturerModel::class, 'product_menufecturer_id');
    }

    /**
     * accessors.
     */

    public function getAverageRatingAttribute()
    {
        return $this->product_reviews()->avg('rating') ?? 0;
    }


    public function getCurrentDiscountPriceAttribute()
    {
        if (auth()->check()) {
            if (auth()->user()->role_serial == 3) {
                return $this->b2c_discount_price;
            }
            if (auth()->user()->role_serial == 6) {
                return $this->b2b_discount_price;
            }
        }
        return $this->b2c_discount_price;
    }

    public function getCurrentPriceAttribute()
    {
        if (auth()->check()) {
            if (auth()->user()->role_serial == 3) {
                return $this->customer_sales_price;
            }
            if (auth()->user()->role_serial == 6) {
                return $this->retailer_sales_price;
            }
        }
        return $this->customer_sales_price;
    }

    public function getFinalPriceAttribute()
    {
        if (auth()->check()) {
            if (auth()->user()->role_serial == 3) {
                return $this->b2c_discount_price ? $this->b2c_discount_price : $this->customer_sales_price;
            }
            if (auth()->user()->role_serial == 6) {
                return $this->b2b_discount_price ? $this->b2b_discount_price : $this->customer_sales_price;;
            }
        }
        return $this->customer_sales_price;
    }

    public function getProductIdAttribute()
    {
        return $this->id;
    }
}
