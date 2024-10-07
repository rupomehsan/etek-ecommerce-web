<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\SearchKeyWord\Database\create_search_key_words_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('search_key_words', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->nullable();
            $table->text('title')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
        Schema::create('url_counts', function (Blueprint $table) {
            $table->id();
            $table->text('url_link')->nullable();
            $table->integer('count')->default(1)->unsigned();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
        Schema::create('url_visit_tracks', function (Blueprint $table) {
            $table->id();
            $table->text('url_link')->nullable();
            $table->text('from_link')->nullable();

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
        Schema::dropIfExists('search_key_words');
        Schema::dropIfExists('url_counts');
        Schema::dropIfExists('url_visit_tracks');
    }
};
