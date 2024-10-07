<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\SalesManagement\SalesOrder\Database\create_sales_orders_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('product_wearhouse_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('product_id', 100)->nullable();
            $table->date('date')->nullable();
            $table->string('order_id', 100)->nullable();
            $table->float('discount_on_all')->nullable();
            $table->enum('discount_on_all_type', ['fixed', 'percentage'])->nullable();
            $table->tinyInteger('is_quotation')->nullable();
            $table->tinyInteger('is_order')->nullable();
            $table->tinyInteger('is_invoiced')->nullable();
            $table->tinyInteger('is_delivered')->nullable();
            $table->tinyInteger('is_paid')->nullable();
            $table->enum('order_type', ['quotation', 'ordered', 'invoiced'])->nullable();
            $table->enum('order_status', ['pending', 'accepted', 'processing', 'on_the_way',  'delivered',  'cancelled', 'refunded'])->nullable();
            $table->float('total')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('paid_amount')->nullable();
            $table->enum('source', ['pos', 'ecommerce', 'retail_order'])->nullable();

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
        Schema::dropIfExists('sales_orders');
    }
};
