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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('grind_type', ['whole_bean', 'coarse', 'medium', 'fine', 'extra_fine'])->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->json('product_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['grind_type', 'weight', 'product_details']);
        });
    }
};
