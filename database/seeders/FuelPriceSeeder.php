<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuelPrice;
use Carbon\Carbon;

class FuelPriceSeeder extends Seeder
{
    public function run(): void
    {
        $products = ['Petrol', 'Diesel', 'Kerosene', 'LP Gas'];
        $regions = ['Kathmandu', 'Pokhara', 'Biratnagar'];

        foreach ($products as $product) {
            foreach ($regions as $region) {
                FuelPrice::create([
                    'product' => $product,
                    'region' => $region,
                    'price' => rand(150, 200),
                    'fetched_at' => Carbon::now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
