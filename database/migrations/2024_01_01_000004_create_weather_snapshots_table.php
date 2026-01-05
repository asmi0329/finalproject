<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weather_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('location'); // e.g., Kathmandu
            $table->string('condition'); // e.g., Sunny, Cloudy
            $table->decimal('temperature_c', 5, 2);
            $table->integer('humidity');
            $table->decimal('wind_kph', 5, 2);
            $table->timestamp('fetched_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_snapshots');
    }
};
