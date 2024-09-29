<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\AccountAndPayments\AccountExpenditureGroups\Database\create_account_expenditure_groups_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_expenditure_groups', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('account_expenditure_groups');
    }
};