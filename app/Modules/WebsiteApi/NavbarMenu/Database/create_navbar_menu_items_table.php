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
        Schema::create('navbar_menu_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('navbar_menus_id')->nullable();
            $table->string('title', 100)->nullable();
            $table->tinyInteger('serial')->nullable();
            $table->tinyInteger('is_visible')->default(1);
            $table->tinyInteger('goto_external_link')->default(0);
            $table->string('external_link', 100)->nullable();
            $table->tinyInteger('is_multiple')->default(0);

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
        Schema::dropIfExists('navbar_menu_items');
    }
};
