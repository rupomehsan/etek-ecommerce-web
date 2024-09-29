<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\UserManagement\User\Database\create_user_payments_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_payments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->string('trx_id', 20)->nullable();
            $table->float('amount')->nullable();

            $table->enum('type', ['debit', 'credit'])->nullable();

            $table->string('reference_table_name', 150)->nullable();
            $table->bigInteger('reference_table_id')->nullable();
            $table->enum('trunsaction_type', [
                'supplier_payment',
                'supplier_refund',
                'customer_advance',
                'customer_order',
                'customer_refund',
            ])->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payments');
    }
};
