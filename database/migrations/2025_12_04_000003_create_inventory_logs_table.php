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
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->integer('quantity_changed');
            $table->enum('action', ['order_created', 'order_cancelled', 'stock_adjustment', 'manual_update']);
            $table->string('reference_type')->nullable(); // 'order', 'manual', etc
            $table->unsignedBigInteger('reference_id')->nullable(); // order_id, etc
            $table->text('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            $table->index('product_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};
