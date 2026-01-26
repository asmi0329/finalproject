<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\WeatherSnapshot;

class WeatherService
{
    protected $baseUrl = 'https://api.open-meteo.com/v1/forecast';
    
    protected $cities = [
        'Kathmandu' => ['lat' => 27.7172, 'lon' => 85.3240],
        'Pokhara' => ['lat' => 28.2096, 'lon' => 83.9856],
        'Biratnagar' => ['lat' => 26.4525, 'lon' => 87.2718],
        'Lalitpur' => ['lat' => 27.6588, 'lon' => 85.3247],
        'Bharatpur' => ['lat' => 27.6833, 'lon' => 84.4339],
        'Birgunj' => ['lat' => 27.0167, 'lon' => 84.8667],
        'Dharan' => ['lat' => 26.8167, 'lon' => 87.2833],
        'Hetauda' => ['lat' => 27.4167, 'lon' => 85.0333],
        'Janakpur' => ['lat' => 26.7271, 'lon' => 85.9056],
        'Nepalgunj' => ['lat' => 28.0500, 'lon' => 81.6167],
    ];

    public function fetchWeatherForCity($cityName)
    {
        if (!isset($this->cities[$cityName])) {
            return null;
        }

        $coordinates = $this->cities[$cityName];
        
        try {
            $response = Http::timeout(10)->get($this->baseUrl, [
                'latitude' => $coordinates['lat'],
                'longitude' => $coordinates['lon'],
                'current' => 'temperature_2m,relativehumidity_2m,windspeed_10m,weathercode',
                'timezone' => 'auto'
            ]);

            if ($response->successful()) {
                return $this->parseWeatherData($response->json(), $cityName);
            }
        } catch (\Exception $e) {
            \Log::error("Weather API error for {$cityName}: " . $e->getMessage());
        }

        return null;
    }

    public function fetchAllCitiesWeather()
    {
        $weatherData = [];
        
        foreach ($this->cities as $cityName => $coordinates) {
            $weather = $this->fetchWeatherForCity($cityName);
            if ($weather) {
                $weatherData[] = $weather;
            }
        }

        return $weatherData;
    }

    public function updateWeatherDatabase()
    {
        $weatherData = $this->fetchAllCitiesWeather();
        
        foreach ($weatherData as $data) {
            WeatherSnapshot::updateOrCreate(
                ['location' => $data['location']],
                [
                    'condition' => $data['condition'],
                    'temperature_c' => $data['temperature_c'],
                    'humidity' => $data['humidity'],
                    'wind_kph' => $data['wind_kph'],
                    'fetched_at' => now(),
                ]
            );
        }

        return count($weatherData);
    }

    protected function parseWeatherData($data, $cityName)
    {
        $current = $data['current'] ?? [];
        $weatherCode = $current['weathercode'] ?? 0;
        
        return [
            'location' => $cityName,
            'condition' => $this->getWeatherCondition($weatherCode),
            'temperature_c' => $current['temperature_2m'] ?? 0,
            'humidity' => $current['relativehumidity_2m'] ?? 0,
            'wind_kph' => ($current['windspeed_10m'] ?? 0) * 3.6, // Convert m/s to km/h
            'weather_code' => $weatherCode,
            'fetched_at' => now(),
        ];
    }

    protected function getWeatherCondition($weatherCode)
    {
        // WMO Weather interpretation codes (https://open-meteo.com/docs/weatherec)
        $conditions = [
            0 => 'Clear',
            1 => 'Mainly Clear',
            2 => 'Partly Cloudy',
            3 => 'Overcast',
            45 => 'Foggy',
            48 => 'Depositing Rime Fog',
            51 => 'Light Drizzle',
            53 => 'Moderate Drizzle',
            55 => 'Dense Drizzle',
            56 => 'Light Freezing Drizzle',
            57 => 'Dense Freezing Drizzle',
            61 => 'Slight Rain',
            63 => 'Moderate Rain',
            65 => 'Heavy Rain',
            66 => 'Light Freezing Rain',
            67 => 'Heavy Freezing Rain',
            71 => 'Slight Snow',
            73 => 'Moderate Snow',
            75 => 'Heavy Snow',
            77 => 'Snow Grains',
            80 => 'Slight Rain Showers',
            81 => 'Moderate Rain Showers',
            82 => 'Violent Rain Showers',
            85 => 'Slight Snow Showers',
            86 => 'Heavy Snow Showers',
            95 => 'Thunderstorm',
            96 => 'Thunderstorm with Slight Hail',
            99 => 'Thunderstorm with Heavy Hail',
        ];

        return $conditions[$weatherCode] ?? 'Unknown';
    }

    public function getAvailableCities()
    {
        return array_keys($this->cities);
    }
}
