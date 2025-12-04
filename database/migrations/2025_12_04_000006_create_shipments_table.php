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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('tracking_number')->unique();
            $table->enum('status', ['pending', 'shipped', 'in_transit', 'delivered', 'failed'])->default('pending');
            $table->string('carrier')->nullable(); // 'ups', 'fedex', 'dhl', etc
            $table->string('carrier_url')->nullable();
            $table->json('tracking_history')->nullable();
            $table->decimal('shipping_cost', 10, 2)->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('expected_delivery_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('order_id');
            $table->index('status');
            $table->index('shipped_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
