<?php

use App\GrindType;
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
        $grindTypes = collect(GrindType::cases())->map(fn ($case) => $case->value)->toArray();

        Schema::table('products', function (Blueprint $table) use ($grindTypes) {
            $table->enum('grind_type', $grindTypes)->nullable();
            $table->decimal('weight', 8, 3)->nullable();
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
