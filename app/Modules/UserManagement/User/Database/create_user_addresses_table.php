<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\UserManagement\User\Database\create_user_addresses_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('is_shipping')->nullable();
            $table->tinyInteger('is_billing')->nullable();
            $table->enum('address_types', ['office', 'pickup_point', 'store','delivery','personal'])->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('state_division_id')->nullable();
            $table->bigInteger('division_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('station_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->tinyInteger('is_present_address')->nullable();
            $table->bigInteger('is_permanent_address')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();

            // $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
