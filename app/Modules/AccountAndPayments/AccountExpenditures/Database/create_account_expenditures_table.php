<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\AccountAndPayments\AccountExpenditures\Database\create_account_expenditures_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_expenditures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_expenditure_group_id')->nullable();
            $table->string('title', 50)->nullable();
            $table->string('description', 100)->nullable();

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
        Schema::dropIfExists('account_expenditures');
    }
};