<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\AccountAndPayments\AccountNumbers\Database\create_account_numbers_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_numbers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_head_id')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->integer('account_number')->nullable();
            $table->string('account_name', 100)->nullable();
            $table->float('amount')->nullable();
            $table->integer('opening_balance')->nullable();
            $table->bigInteger('account_transaction_id')->nullable();

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
        Schema::dropIfExists('account_numbers');
    }
};