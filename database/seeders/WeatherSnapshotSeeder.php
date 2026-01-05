<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeatherSnapshot;
use Carbon\Carbon;

class WeatherSnapshotSeeder extends Seeder
{
    public function run(): void
    {
        $locations = ['Kathmandu', 'Pokhara', 'Lalitpur', 'Bhaktapur'];
        $conditions = ['Sunny', 'Cloudy', 'Rainy', 'Partly Cloudy'];

        foreach ($locations as $location) {
            WeatherSnapshot::create([
                'location' => $location,
                'condition' => $conditions[array_rand($conditions)],
                'temperature_c' => rand(15, 30),
                'humidity' => rand(40, 80),
                'wind_kph' => rand(5, 20),
                'fetched_at' => Carbon::now(),
            ]);
        }
    }
}
