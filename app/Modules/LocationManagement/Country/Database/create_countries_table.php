<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\LocationManagement\Country\Database\create_countries_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('location_countries', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('country_code',20)->nullable();
            $table->string('country_short_code',20)->nullable();
            $table->string('flag_url',200)->nullable();
            $table->json('country_symbol')->nullable();
            $table->integer('serial')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 100)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_countries');
    }
};
