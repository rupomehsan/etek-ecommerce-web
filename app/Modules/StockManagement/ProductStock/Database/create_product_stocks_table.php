<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\StockManagement\ProductStock\Database\create_product_stocks_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->enum('stock_type', ['initial', 'purchase', 'sales', 'return', 'waste'])->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->string('bill_receipt_no', 50)->nullable();
            $table->bigInteger('product_wearhouse_id')->nullable();

            $table->bigInteger('purchase_order_id')->nullable();
            $table->bigInteger('purchase_return_id')->nullable();

            $table->bigInteger('sales_order_id')->nullable();
            $table->bigInteger('sales_return_id')->nullable();

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
        Schema::dropIfExists('product_stocks');
    }
};
