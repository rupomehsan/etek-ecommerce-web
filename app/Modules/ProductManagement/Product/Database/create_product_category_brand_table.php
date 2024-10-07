<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\Product\Database\create_product_category_brand_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_category_brand', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_category_id')->nullable();
            $table->bigInteger('product_brand_id')->nullable();
            $table->bigInteger('total_product')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_brand');
    }
};
