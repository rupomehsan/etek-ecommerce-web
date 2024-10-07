
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
            $table->string('pu_base_unit_label', 100)->nullable();
            $table->string('pu_b2c_sales_unit_label', 100)->nullable();
            $table->string('pu_b2b_sales_unit_label', 100)->nullable();
            $table->string('pu_b2b_sales_unit_label', 100)->nullable();
            $table->string('pv_attribute', 100)->nullable();
            $table->string('pv_sku', 100)->nullable();
            $table->bigInteger('pv_id')->nullable();
            $table->bigInteger('pv_p_id')->nullable();
            $table->bigInteger('pv_medicine_id')->nullable();
            $table->float('pv_mrp')->nullable();
            $table->float('pv_b2c_discounted_price')->nullable();
            $table->bigInteger('pv_b2c_min_qty')->nullable();
            $table->bigInteger('pv_b2c_max_qty')->nullable();
            $table->float('pv_b2b_discounted_price')->nullable();
            $table->bigInteger('pv_b2b_min_qty')->nullable();
            $table->bigInteger('pv_b2b_max_qty')->nullable();
            $table->bigInteger('pv_allow_purchase')->nullable();
            $table->bigInteger('pv_allow_sales')->nullable();
            $table->bigInteger('pv_is_base')->nullable();
            $table->bigInteger('pv_sales_vat')->nullable();
            $table->bigInteger('pv_stock_status')->nullable();
            $table->float('pv_weight')->nullable();
            $table->text('pv_slug')->nullable();
            $table->bigInteger('pv_weekly_requirement')->nullable();
            $table->bigInteger('pv_dimension')->nullable();
            $table->float('pv_purchase_price', 100)->nullable();
            $table->bigInteger('pv_trending_score', 100)->nullable();

            $table->string('pv_created_at', 100)->nullable();
            $table->string('pv_created_by', 100)->nullable();
            $table->string('pv_modified_at', 100)->nullable();
            $table->string('pv_modified_by', 100)->nullable();
            $table->string('pv_deleted_at', 100)->nullable();
            $table->string('pv_deleted_by', 100)->nullable();

            $table->float('pv_b2c_price')->nullable();
            $table->float('pv_b2b_price')->nullable();
            $table->bigInteger('pv_b2c_mrp')->nullable();
            $table->bigInteger('pv_b2b_mrp')->nullable();

            $table->bigInteger('pu_base_unit_multiplier')->nullable();
            $table->bigInteger('pu_b2c_base_unit_multiplier')->nullable();
            $table->bigInteger('pu_b2b_base_unit_multiplier')->nullable();
            $table->bigInteger('pu_b2c_sales_unit_id')->nullable();
            $table->bigInteger('pu_b2b_sales_unit_id')->nullable();
            $table->bigInteger('pv_b2c_discount_percent')->nullable();
            $table->bigInteger('pv_b2b_discount_percent')->nullable();

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
