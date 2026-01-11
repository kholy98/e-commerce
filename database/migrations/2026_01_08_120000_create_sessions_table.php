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
        // Check if sessions table already exists
        if (!Schema::hasTable('sessions')) {
            // Create the table if it doesn't exist
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity')->index();
            });
        } else {
            // Table exists, add any missing columns
            Schema::table('sessions', function (Blueprint $table) {
                if (!Schema::hasColumn('sessions', 'id')) {
                    $table->string('id')->primary();
                }
                if (!Schema::hasColumn('sessions', 'user_id')) {
                    $table->foreignId('user_id')->nullable()->index();
                }
                if (!Schema::hasColumn('sessions', 'ip_address')) {
                    $table->string('ip_address', 45)->nullable();
                }
                if (!Schema::hasColumn('sessions', 'user_agent')) {
                    $table->text('user_agent')->nullable();
                }
                if (!Schema::hasColumn('sessions', 'payload')) {
                    $table->text('payload');
                }
                if (!Schema::hasColumn('sessions', 'last_activity')) {
                    $table->integer('last_activity')->index();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if this migration created the table
        // Be careful not to drop existing sessions tables
        if (Schema::hasTable('sessions')) {
            // Check if this is a standard Laravel sessions table
            $columns = Schema::getColumnListing('sessions');
            $expectedColumns = ['id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];

            // Only drop if it has our expected structure
            if (count(array_intersect($expectedColumns, $columns)) >= 3) {
                Schema::dropIfExists('sessions');
            }
        }
    }
};