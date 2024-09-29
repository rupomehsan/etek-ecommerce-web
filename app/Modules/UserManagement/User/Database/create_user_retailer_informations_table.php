<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\UserManagement\User\Database\create_user_retailer_informations_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_retailer_informations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('retailer_id')->nullable();
            $table->bigInteger('retailer_type_id')->nullable();
            $table->string('alt_email', 50)->nullable();
            $table->string('alt_mobile_number', 20)->nullable();
            $table->string('shop_name', 50)->nullable();
            $table->string('license_number', 50)->nullable();

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
        Schema::dropIfExists('user_retailer_informations');
    }
};
