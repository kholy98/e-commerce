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
        Schema::table('team_members', function (Blueprint $table) {
            $table->renameColumn('full_name', 'fullname');
            $table->dropColumn('bio');
            $table->dropColumn('image_path');
            $table->json('social_media')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->renameColumn('fullname', 'full_name');
            $table->dropColumn('social_media');
            $table->text('bio')->nullable()->after('email');
            $table->string('image_path')->nullable()->after('bio');
        });
    }
};
