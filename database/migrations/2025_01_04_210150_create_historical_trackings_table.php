<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('historical_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke users
            $table->date('date'); // Tanggal aktivitas
            $table->double('commuting_method_value')->default(0); // Nilai dari commuting
            $table->double('energy_source_value')->default(0); // Nilai dari energy source
            $table->double('dietary_preference_value')->default(0); // Nilai dari diet
            $table->double('carbon_footprint')->default(0); // Total jejak karbon
            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historical_trackings');
    }
}
