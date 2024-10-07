<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\SalesManagement\SalesOrder\Database\create_sales_quotation_order_products_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_quotation_order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_quotation_order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->float('product_price')->nullable();
            $table->float('product_name')->nullable();
            $table->integer('qty')->nullable();
            $table->float('discount')->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable();
            $table->enum('tax', ['fixed', 'percentage'])->nullable();
            $table->float('total')->nullable();
            $table->float('subtotal')->nullable();

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
        Schema::dropIfExists('sales_quotation_order_products');
    }
};
