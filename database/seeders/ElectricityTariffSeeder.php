<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ElectricityTariff;
use Carbon\Carbon;

class ElectricityTariffSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Domestic', 'Industrial', 'Commercial'];
        $slabs = ['0-20 units', '21-50 units', '51-150 units', '151-250 units'];

        foreach ($categories as $category) {
            foreach ($slabs as $slab) {
                ElectricityTariff::create([
                    'category' => $category,
                    'slab' => $slab,
                    'rate' => rand(5, 15),
                    'fetched_at' => Carbon::now(),
                ]);
            }
        }
    }
}
