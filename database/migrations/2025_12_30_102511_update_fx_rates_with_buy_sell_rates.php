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
        Schema::table('fx_rates', function (Blueprint $table) {
            $table->string('currency_name')->nullable()->after('base_currency');
            $table->integer('unit')->default(1)->after('currency_name');
            $table->decimal('buy_rate', 15, 4)->nullable()->after('unit');
            $table->decimal('sell_rate', 15, 4)->nullable()->after('buy_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fx_rates', function (Blueprint $table) {
            $table->dropColumn(['currency_name', 'unit', 'buy_rate', 'sell_rate']);
        });
    }
};
