<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\ProductVarientValue\Database\create_product_varient_values_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_varient_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_varient_group_id')->nullable();
            $table->bigInteger('product_varient_id')->nullable();
            $table->text('title')->nullable()->comment('varient title'); //
            $table->string('value', 120)->nullable()->comment('varient value ex:red, blue, etc');
            $table->string('value2', 120)->nullable()->comment('varient value 2 ex:  #00000,#11111');
            $table->tinyInteger('is_default')->default(0);

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
        Schema::dropIfExists('product_varient_values');
    }
};
