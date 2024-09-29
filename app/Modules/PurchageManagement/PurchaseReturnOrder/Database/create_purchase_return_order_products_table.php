<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\PurchageManagement\PurchaseOrder\Database\create_purchase_return_order_products_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_return_order_products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('purchase_order_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('purchase_price')->nullable();
            $table->integer('qty')->nullable();

            $table->float('discount')->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable();

            $table->enum('tax', ['fixed', 'percentage'])->nullable();
            $table->float('total')->nullable();
            $table->float('subtotal')->nullable();

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
        Schema::dropIfExists('purchase_return_order_products');
    }
};
