<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\Product\Database\create_products_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_group_id')->nullable();

            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_available')->default(1)->comment('everything is ok but can not buy');
            $table->tinyInteger('is_pre_order')->default(0);
            $table->tinyInteger('is_up_coming')->default(0);
            $table->tinyInteger('is_emi_support')->default(0);
            $table->tinyInteger('is_best_selling')->default(0);
            $table->tinyInteger('is_trending')->default(0);
            $table->tinyInteger('is_free_delivery')->default(0);
            $table->bigInteger('total_sold')->default(0)->unsigned();

            $table->string('barcode', 100)->nullable();

            $table->enum('type', ['service', 'product','medicine'])->nullable();
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->json('specifications')->nullable();
            $table->string('video_url')->nullable();

            $table->integer('product_menufecturer_id')->nullable();
            $table->integer('product_brand_id')->nullable();
            $table->string('sku', 50)->nullable();
            $table->integer('product_unit_id')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();

            $table->integer('alert_quantity')->nullable();

            $table->float('seller_points')->nullable();
            $table->tinyInteger('is_returnable')->nullable();
            $table->string('expiration_days')->nullable();

            $table->integer('product_warranty')->nullable()->comment('how many month');
            $table->longText('warranty_policy')->nullable();
            $table->longText('guarenty_policy')->nullable();

            $table->enum('price_type', ['single', 'variant'])->nullable();

            // $table->string('purchase_account')->nullable();

            // $table->string('tax_id')->nullable();
            $table->enum('tax_type', ['inclusive', 'exclusive'])->nullable();
            $table->float('tax_amount')->default(0)->unsigned();

            // $table->integer('vat_on_sale')->nullable();
            // $table->integer('vat_on_purchase')->nullable();

            $table->float('purchase_price')->nullable();
            $table->float('customer_sales_price')->nullable()->unsigned();
            $table->float('retailer_sales_price')->nullable()->unsigned();
            $table->float('minimum_sale_price')->nullable()->unsigned();
            $table->float('maximum_sale_price')->nullable()->unsigned();
            $table->float('emi_price')->nullable();
            $table->float('profit_margin_percent')->nullable();


            $table->enum('discount_type', ['off', 'percent', 'flat'])->nullable();
            $table->float('discount_amount')->nullable();

            $table->string('meta_title', 150)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('search_keywords')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 150)->nullable();
            $table->tinyInteger('is_hide')->default(0)->comment('emergency hide from frontend');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
