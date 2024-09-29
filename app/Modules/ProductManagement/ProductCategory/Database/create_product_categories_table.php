<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\ProductCategory\Database\create_product_categories_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('product_category_group_id')->nullable();
            $table->tinyInteger('is_nav')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->Integer('serial')->nullable();
            $table->string('image', 100)->nullable();

            $table->string('meta_title', 150)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('search_keywords')->nullable();

            $table->string('page_header_title', 200)->nullable();
            $table->text('page_header_description')->nullable();
            $table->string('page_full_description_title', 200)->nullable();
            $table->text('page_full_description')->nullable();

            $table->string('related_product_title', 200)->nullable();

            $table->string('bc_url', 200)->nullable();
            $table->bigInteger('bc_id')->nullable();


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
        Schema::dropIfExists('product_categories');
    }
};
