<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FxRate;
use Carbon\Carbon;

class FxRateSeeder extends Seeder
{
    public function run(): void
    {
        $currencies = ['USD', 'EUR', 'GBP', 'AUD', 'JPY'];

        foreach ($currencies as $currency) {
            for ($i = 0; $i < 5; $i++) {
                FxRate::create([
                    'base_currency' => $currency,
                    'target_currency' => 'NPR',
                    'rate' => rand(100, 150),
                    'fetched_at' => Carbon::now()->subDays($i),
                ]);
            }
        }
    }
}
