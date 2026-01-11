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
        Schema::create('pending_checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index(); // Link to user session
            $table->string('temp_order_id')->unique(); // Paymob temporary order ID
            $table->json('order_data'); // Complete order information
            $table->json('shipment_data'); // Shipment tracking info
            $table->timestamp('created_at');
            $table->timestamp('expires_at')->index(); // For cleanup
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_checkouts');
    }
};
