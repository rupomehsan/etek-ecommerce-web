<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\ProductVarientGroupTitle\Database\create_product_varient_group_titles_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_varient_group_titles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_varient_id')->nullable();
            $table->string('title', 100)->nullable();

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
        Schema::dropIfExists('product_varient_group_titles');
    }
};