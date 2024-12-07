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
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->integer('commuting_method_value')->nullable()->after('commuting_method_id');
            $table->integer('dietary_preference_value')->nullable()->after('dietary_preference_id');
            $table->integer('energy_source_value')->nullable()->after('energy_source_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn('commuting_method_value');
            $table->dropColumn('dietary_preference_value');
            $table->dropColumn('energy_source_value');
        });
    }
};
