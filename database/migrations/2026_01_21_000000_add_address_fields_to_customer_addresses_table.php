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
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->string('street')->nullable()->after('address');
            $table->string('building_number')->nullable()->after('street');
            $table->string('floor')->nullable()->after('building_number');
            $table->string('apartment')->nullable()->after('floor');
            $table->string('zone')->nullable()->after('apartment');

            // Update default values for is_billing and is_shipping
            $table->boolean('is_billing')->default(true)->change();
            $table->boolean('is_shipping')->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropColumn(['street', 'building_number', 'floor', 'apartment', 'zone']);

            // Revert defaults
            $table->boolean('is_billing')->default(false)->change();
            $table->boolean('is_shipping')->default(true)->change();
        });
    }
};
