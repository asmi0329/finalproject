<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WeatherService;
use App\Models\WeatherSnapshot;

class FetchWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:fetch {city? : Specific city to fetch weather for}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch weather data from Open-Meteo API for Nepal cities';

    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument('city');
        
        $this->info('Fetching weather data...');
        
        if ($city) {
            $this->fetchSingleCity($city);
        } else {
            $this->fetchAllCities();
        }
    }

    protected function fetchSingleCity($city)
    {
        $this->info("Fetching weather for {$city}...");
        
        $weather = $this->weatherService->fetchWeatherForCity($city);
        
        if ($weather) {
            WeatherSnapshot::updateOrCreate(
                ['location' => $weather['location']],
                [
                    'condition' => $weather['condition'],
                    'temperature_c' => $weather['temperature_c'],
                    'humidity' => $weather['humidity'],
                    'wind_kph' => $weather['wind_kph'],
                    'fetched_at' => now(),
                ]
            );
            
            $this->info("✓ Weather updated for {$city}: {$weather['temperature_c']}°C, {$weather['condition']}");
        } else {
            $this->error("✗ Failed to fetch weather for {$city}");
        }
    }

    protected function fetchAllCities()
    {
        $count = $this->weatherService->updateWeatherDatabase();
        
        $this->info("✓ Successfully updated weather data for {$count} cities");
        
        // Display summary
        $weatherData = WeatherSnapshot::latest('fetched_at')->take(10)->get();
        $this->table(
            ['City', 'Temperature', 'Condition', 'Humidity', 'Wind Speed'],
            $weatherData->map(function ($weather) {
                return [
                    $weather->location,
                    $weather->temperature_c . '°C',
                    $weather->condition,
                    $weather->humidity . '%',
                    number_format($weather->wind_kph, 1) . ' km/h',
                ];
            })
        );
    }
}
