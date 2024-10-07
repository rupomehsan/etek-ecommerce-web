<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\SalesManagement\SalesInvoice\Database\create_sales_invoices_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 100)->nullable();
            $table->date('date')->nullable();

            $table->enum('user_type', ['ecommerce', 'retail_order'])->nullable();
            $table->bigInteger('customer_id')->nullable()->unsigned();

            $table->tinyInteger('is_delivered')->default(0);
            $table->enum('order_status', ['pending', 'acccepted', 'processing', 'on_the_way',  'delivered',  'cancelled', 'refunded'])->nullable();

            $table->bigInteger('user_address_id')->nullable();
            $table->enum('delivery_method', ['pickup', 'courier', 'home_delivery'])->nullable();
            $table->string('delivery_address')->nullable();
            $table->float('delivery_charge')->nullable();
            $table->float('additional_charge')->nullable();

            $table->bigInteger('product_coupon_id')->nullable();
            $table->float('coupon_discount')->nullable();



            $table->float('subtotal')->nullable();
            $table->float('discount')->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable();
            $table->float('total')->nullable();


            $table->tinyInteger('is_paid')->nullable();
            $table->float('paid_amount')->nullable();

            $table->string('payment_id', 20)->nullable();
            $table->string('payment_method', 20)->nullable();



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
        Schema::dropIfExists('sales_invoices');
    }
};
