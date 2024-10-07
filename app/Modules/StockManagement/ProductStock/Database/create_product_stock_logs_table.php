<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\StockManagement\ProductStock\Database\create_product_stock_logs_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_stock_logs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_wearhouse_id')->nullable();
            $table->date('date')->nullable();
            $table->enum('stock_type', ['initial', 'purchase', 'sales', 'return', 'waste'])->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->integer('qty')->nullable();

            $table->bigInteger('purchase_order_id')->nullable();
            $table->bigInteger('purchase_return_id')->nullable();

            $table->bigInteger('sales_order_id')->nullable();
            $table->bigInteger('sales_return_id')->nullable();

            $table->bigInteger('product_waste_id')->nullable();

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
        Schema::dropIfExists('product_stock_logs');
    }
};
