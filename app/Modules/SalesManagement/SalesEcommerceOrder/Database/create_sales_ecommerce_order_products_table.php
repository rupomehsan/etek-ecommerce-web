<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\SalesManagement\SalesEcommerceOrder\Database\create_sales_ecommerce_order_products_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_ecommerce_order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_ecommerce_order_id')->nullable();

            $table->integer('product_id')->nullable();
            $table->float('product_price')->default(0);
            $table->string('product_name')->nullable();

            $table->enum('discount_type', ['fixed', 'percentage'])->nullable();
            $table->enum('tax', ['fixed', 'percentage'])->nullable();

            $table->float('discount')->default(0);
            $table->float('price')->default(0);
            $table->integer('qty')->default(0);

            $table->float('subtotal')->default(0);
            $table->float('tax_total')->default(0);

            $table->float('total')->default(0);

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
        Schema::dropIfExists('sales_ecommerce_order_products');
    }
};
