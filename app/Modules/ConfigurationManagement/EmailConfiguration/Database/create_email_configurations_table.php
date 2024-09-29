<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ConfigurationManagement\EmailConfiguration\Database\create_email_configurations_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_configurations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['tls', 'ssl'])->nullable();
            $table->string('email', 50)->nullable();
            $table->string('user', 50)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('host', 50)->nullable();
            $table->string('port', 50)->nullable();
            $table->tinyInteger('is_active')->default(0)->nullable();

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
        Schema::dropIfExists('email_configurations');
    }
};
