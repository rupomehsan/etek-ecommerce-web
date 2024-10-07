<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\BannerManagement\HomeSideBanner\Database\create_home_side_banners_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_side_banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_one', 150)->nullable();
            $table->string('banner_two', 150)->nullable();
            $table->string('banner_three', 150)->nullable();
            $table->string('banner_four', 150)->nullable();

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
        Schema::dropIfExists('home_side_banners');
    }
};