<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\BlogManagement\Blog\Database\create_blogs_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('publish_date', 100)->nullable();
            $table->string('writer', 50)->nullable();

            $table->string('thumbnail_image', 100)->nullable();
            $table->json('image')->nullable();
            $table->string('blog_type', 20)->nullable();
            $table->string('video_url', 150)->nullable();
            $table->enum('privecy_status', ['public', 'private'])->default('public');

            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 100)->nullable();
            $table->string('meta_keywords', 200)->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('blog_post_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_id')->nullable();
            $table->bigInteger('blog_category_id')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_post_categories');
    }
};
