<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\PurchageManagement\PurchaseOrder\Database\create_purchase_charges_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_charges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_order_id')->nullable();
            $table->bigInteger('purchase_order_product_id')->nullable();
            $table->bigInteger('vat_id')->nullable();
            $table->bigInteger('vat_group_id')->nullable();
            $table->float('amount')->nullable()->unsigned();

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
        Schema::dropIfExists('purchase_charges');
    }
};
