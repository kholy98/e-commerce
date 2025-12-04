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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('label')->nullable(); // 'home', 'work', etc
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('zip_code');
            $table->string('country');
            $table->string('state')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_billing')->default(false);
            $table->boolean('is_shipping')->default(true);
            $table->timestamps();
            $table->index('user_id');
            $table->index('is_default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
