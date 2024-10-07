<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navbar_menu_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('navbar_menu_id')->nullable();
            $table->bigInteger('navbar_menu_items_id')->nullable();

            $table->longText('title')->nullable();
            $table->longText('description')->nullable();

            $table->string('source_title', 100)->nullable();
            $table->string('source_url', 100)->nullable();
            $table->string('source_file', 100)->nullable();

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
        Schema::dropIfExists('navbar_menu_details');
    }
};
