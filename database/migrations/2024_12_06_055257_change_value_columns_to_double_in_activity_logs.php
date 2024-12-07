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
            // Change the type of the value columns to double
            $table->double('commuting_method_value', 8, 2)->change();
            $table->double('dietary_preference_value', 8, 2)->change();
            $table->double('energy_source_value', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            // Revert the columns to their original integer type
            $table->integer('commuting_method_value')->change();
            $table->integer('dietary_preference_value')->change();
            $table->integer('energy_source_value')->change();
        });
    }
};
