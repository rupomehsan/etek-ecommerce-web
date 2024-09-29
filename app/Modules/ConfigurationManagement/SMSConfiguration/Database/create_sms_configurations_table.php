<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\ConfigurationManagement\SMSConfiguration\Database\create_sms_configurations_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('con_sms_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('sms_provider', 50)->nullable();
            $table->string('sms_gateway_url', 100)->nullable();
            $table->string('port', 50)->nullable();
            $table->string('api_key', 50)->nullable();
            $table->string('secret_key', 50)->nullable();
            $table->string('caller_id', 100)->nullable();
            $table->string('user_name', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('caller_phone_number', 20)->nullable();

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
        Schema::dropIfExists('con_sms_configurations');
    }
};
