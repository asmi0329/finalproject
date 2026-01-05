<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            FuelPriceSeeder::class,
            ElectricityTariffSeeder::class,
            FxRateSeeder::class,
            WeatherSnapshotSeeder::class,
            MetalPriceSeeder::class,
        ]);
    }
}
