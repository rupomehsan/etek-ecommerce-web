<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\UserManagement\User\Database\create_user_employee_informations_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_employee_informations', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('nick_name', 40)->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('employee_code')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_employee_informations');
    }
};
