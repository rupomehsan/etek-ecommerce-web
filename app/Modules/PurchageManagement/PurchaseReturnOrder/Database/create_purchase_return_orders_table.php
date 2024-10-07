<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\PurchageManagement\PurchaseReturnOrder\Database\create_purchase_return_orders_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_return_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_wearhouse_id')->nullable();
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->date('date')->nullable();
            $table->string('reference')->nullable();
            $table->Integer('discount_on_all')->nullable();
            $table->enum('discount_on_all_type',['percentage','fixed'])->nullable();
            $table->bigInteger('subtotal')->nullable();
            $table->bigInteger('total')->nullable();

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
        Schema::dropIfExists('purchase_return_orders');
    }
};
