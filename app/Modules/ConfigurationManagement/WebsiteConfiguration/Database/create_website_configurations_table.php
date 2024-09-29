<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ConfigurationManagement\WebsiteConfiguration\Database\create_website_configurations_table.php'
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('con_setting_title', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('con_setting_title_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('setting_title_id')->nullable();
            $table->string('title', 100)->nullable();
            $table->text('value')->nullable();
            // $table->json('values')->nullable();
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
        Schema::dropIfExists('con_setting_title');
        Schema::dropIfExists('con_setting_title_values');
    }
};
