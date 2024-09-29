<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\LocationManagement\StateDivision\Database\create_state_divisions_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('location_state_divisions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->nullable();
            $table->string('name',50)->nullable();

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
        Schema::dropIfExists('location_state_divisions');
    }
};
