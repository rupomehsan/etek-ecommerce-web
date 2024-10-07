<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\StockManagement\ProductWearHouseBranch\Database\create_product_wear_house_branches_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_wear_house_branches', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->nullable();

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
        Schema::dropIfExists('product_wear_house_branches');
    }
};