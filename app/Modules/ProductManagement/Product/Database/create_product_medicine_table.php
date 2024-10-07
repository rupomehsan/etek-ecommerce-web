
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\Product\Database\create_product_medicine_varients_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_medicine_varients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();
            $table->text('p_name')->nullable();
            $table->string('p_strength',100)->nullable();
            $table->bigInteger('p_generic_id')->nullable();
            $table->text('p_generic_name')->nullable();
            $table->bigInteger('p_company_id')->nullable();
            $table->bigInteger('p_manufacturer_id')->nullable();
            $table->string('p_type')->nullable();
            $table->string('p_manufacturer')->nullable();
            $table->text('p_product_keywords')->nullable();
            $table->bigInteger('p_brand_id')->nullable();
            $table->string('p_brand')->nullable();
            $table->bigInteger('is_antibiotics')->nullable();


        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_medicine_varients');
    }
};
