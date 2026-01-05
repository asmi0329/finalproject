<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MetalPrice;
use Carbon\Carbon;

class MetalPriceSeeder extends Seeder
{
    public function run(): void
    {
        $metals = ['Gold', 'Silver', 'Platinum'];

        foreach ($metals as $metal) {
            MetalPrice::create([
                'metal_type' => $metal,
                'price' => rand(90000, 120000),
                'unit' => 'per 10g',
                'currency' => 'NPR',
                'fetched_at' => Carbon::now(),
            ]);
        }
    }
}
