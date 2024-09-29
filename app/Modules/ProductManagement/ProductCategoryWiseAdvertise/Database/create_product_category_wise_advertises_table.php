<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Database\create_product_category_wise_advertises_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_category_wise_advertises', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_category_id')->nullable();
            $table->string('title', 100)->nullable();
            $table->tinyInteger('is_promition')->default(0);
            $table->string('image', 100)->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_data')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_wise_advertises');
    }
};
