<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('electricity_tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // e.g., Domestic, Industrial
            $table->string('slab'); // e.g., 0-20 units
            $table->decimal('rate', 8, 2); // Price per unit
            $table->timestamp('fetched_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('electricity_tariffs');
    }
};
