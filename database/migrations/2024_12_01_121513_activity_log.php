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
        //
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('commuting_method_id')->constrained()->onDelete('cascade');
            $table->foreignId('dietary_preference_id')->constrained()->onDelete('cascade');
            $table->foreignId('energy_source_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('activity_logs');
    }
};
