<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\UserManagement\User\Database\create_payment_remainses_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_remainses', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->nullable();
            $table->float('amount')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();

            // $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_remainses');
    }
};
