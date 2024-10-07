
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ProductManagement\Product\Database\create_product_view_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_view', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_view');
    }
};
