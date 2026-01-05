<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fuel_prices', function (Blueprint $table) {
            $table->boolean('is_manual')->default(false)->after('price');
        });
        Schema::table('electricity_tariffs', function (Blueprint $table) {
            $table->boolean('is_manual')->default(false)->after('rate');
        });
        Schema::table('fx_rates', function (Blueprint $table) {
            $table->boolean('is_manual')->default(false)->after('rate');
        });
        Schema::table('metal_prices', function (Blueprint $table) {
            $table->boolean('is_manual')->default(false)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fuel_prices', function (Blueprint $table) {
            $table->dropColumn('is_manual');
        });
        Schema::table('electricity_tariffs', function (Blueprint $table) {
            $table->dropColumn('is_manual');
        });
        Schema::table('fx_rates', function (Blueprint $table) {
            $table->dropColumn('is_manual');
        });
        Schema::table('metal_prices', function (Blueprint $table) {
            $table->dropColumn('is_manual');
        });
    }
};
