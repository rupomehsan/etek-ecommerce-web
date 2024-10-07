<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\ProductMenufacturer\Database\create_product_menufacturers_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_menufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->Integer('serial')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('product_menufacturers');
    }
};
