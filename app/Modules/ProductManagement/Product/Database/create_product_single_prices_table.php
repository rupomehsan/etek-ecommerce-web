<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\Product\Database\create_product_single_prices_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_single_prices', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')->nullable();
            $table->string('title', 150)->nullable();
            $table->string('sku', 50)->nullable();
            $table->string('hsn', 50)->nullable();

            $table->float('price_without_tax')->nullable();
            $table->float('purchase_price')->nullable();
            $table->float('sales_price')->nullable();
            $table->float('profit_margin_percent')->nullable();
            $table->float('retail_sales_price')->nullable();

            $table->float('mrp')->nullable();
            $table->integer('opening_stock')->nullable();
            $table->integer('wear_house_id')->nullable();

            $table->integer('product_varient_group_id')->nullable();
            $table->integer('product_varient_varient_id')->nullable();
            $table->integer('product_varient_value_id')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 150)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_single_prices');
    }
};
