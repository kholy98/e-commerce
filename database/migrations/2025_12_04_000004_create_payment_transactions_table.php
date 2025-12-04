<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->enum('payment_method', ['credit_card', 'debit_card', 'paypal', 'bank_transfer', 'other'])->nullable();
            $table->string('transaction_id')->nullable()->unique();
            $table->string('reference_number')->nullable();
            $table->json('gateway_response')->nullable(); // Store full gateway response
            $table->text('failure_reason')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->index('order_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
