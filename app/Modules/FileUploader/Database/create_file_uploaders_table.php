<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\FileUploader\Database\create_file_uploaders_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('file_uploaders', function (Blueprint $table) {
            $table->id();
            $table->string('url', 200)->nullable();
            $table->string('alt', 100)->nullable();
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
        Schema::dropIfExists('file_uploaders');
    }
};
