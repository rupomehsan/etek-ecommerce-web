<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\WebsiteApi\WebsiteSubscriber\Database\create_website_subscribers_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone_number', 20)->nullable();

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
        Schema::dropIfExists('website_subscribers');
    }
};