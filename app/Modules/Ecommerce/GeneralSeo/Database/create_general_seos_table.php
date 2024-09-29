<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Ecommerce\GeneralSeo\Database\create_general_seos_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_seos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->text('value')->nullable();

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
        Schema::dropIfExists('general_seos');
    }
};