<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\WeatherSnapshot;
use App\Models\FxRate;
use App\Models\FuelPrice;
use App\Models\MetalPrice;
use App\Models\ElectricityTariff;

class FetchRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest rates from APIs and mock sources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting rates fetch...');

        // 1. Weather
        try {
            $this->fetchWeather();
        } catch (\Exception $e) {
            $this->error('Weather failed: ' . $e->getMessage());
        }

        // 2. Fx Rates
        try {
            $this->fetchFxRates();
        } catch (\Exception $e) {
            $this->error('FX Rates failed: ' . $e->getMessage());
        }

        // 3. Fuel Prices
        try {
            $this->fetchFuelPrices();
        } catch (\Exception $e) {
            $this->error('Fuel Prices failed: ' . $e->getMessage());
            // Fallback to mock if API is down
            $this->mockFuelPrices();
        }

        // 4. Metal Prices
        try {
            $this->fetchMetalPrices();
        } catch (\Exception $e) {
            $this->error('Metal Prices failed: ' . $e->getMessage());
        }

        // 5. Electricity
        try {
            $this->checkElectricity();
        } catch (\Exception $e) {
            $this->error('Electricity check failed: ' . $e->getMessage());
        }

        $this->info('Rates process completed!');
    }

    private function fetchWeather()
    {
        $this->info('Fetching Nepal Weather API...');

        try {
            // Using the user-suggested Nepal Weather API (unofficial but specialized for Nepal)
            $response = Http::get("https://nepal-weather-api.herokuapp.com/api/?place=all");

            if ($response->successful()) {
                $data = $response->json();
                // Depending on the API version, it might be an array directly or inside a payload
                $weatherList = $data['payload'] ?? $data;

                if (is_array($weatherList)) {
                    foreach ($weatherList as $item) {
                        if (!isset($item['place']))
                            continue;

                        WeatherSnapshot::updateOrCreate(
                            ['location' => $item['place']],
                            [
                                'temperature_c' => (float) $item['max'] ?? 0,
                                'condition' => 'Scattered Clouds', // Mock condition as API only gives Max/Min/Rain
                                'humidity' => 65,
                                'wind_kph' => 10,
                                'fetched_at' => now(),
                            ]
                        );
                    }
                    $this->info('Nepal Weather API sync complete.');
                }
            } else {
                $this->warn('Nepal Weather API unreachable. Falling back to Open-Meteo for major cities...');
                $this->fetchWeatherFallback(); // I'll rename the old method to this
            }
        } catch (\Exception $e) {
            $this->error("Weather Sync Error: " . $e->getMessage());
            $this->fetchWeatherFallback();
        }
    }

    private function fetchWeatherFallback()
    {
        $cities = [
            'Kathmandu' => ['lat' => 27.71, 'lon' => 85.32],
            'Pokhara' => ['lat' => 28.20, 'lon' => 83.98],
        ];

        foreach ($cities as $name => $coords) {
            $response = Http::get("https://api.open-meteo.com/v1/forecast", [
                'latitude' => $coords['lat'],
                'longitude' => $coords['lon'],
                'current_weather' => true,
            ]);
            if ($response->successful()) {
                $current = $response->json()['current_weather'];
                WeatherSnapshot::updateOrCreate(
                    ['location' => $name],
                    ['temperature_c' => $current['temperature'], 'condition' => 'Cloudy', 'fetched_at' => now()]
                );
            }
        }
    }

    private function getWeatherCondition($code)
    {
        $conditions = [
            0 => 'Clear Sky',
            1 => 'Mainly Clean',
            2 => 'Partly Cloudy',
            3 => 'Overcast',
            45 => 'Fog',
            48 => 'Depositing Rime Fog',
            51 => 'Light Drizzle',
            53 => 'Moderate Drizzle',
            55 => 'Dense Drizzle',
            61 => 'Slight Rain',
            63 => 'Moderate Rain',
            65 => 'Heavy Rain',
            71 => 'Slight Snow Fall',
            73 => 'Moderate Snow Fall',
            75 => 'Heavy Snow Fall',
            95 => 'Thunderstorm',
        ];
        return $conditions[$code] ?? 'Cloudy';
    }

    private function fetchFxRates()
    {
        $this->info('Fetching Official NRB Forex Rates...');
        $today = now()->format('Y-m-d');

        try {
            // Using Official Nepal Rastra Bank API
            $response = Http::get("https://www.nrb.org.np/api/forex/v1/rates", [
                'from' => $today,
                'to' => $today,
                'page' => 1,
                'per_page' => 100
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $ratesList = $data['data']['payload'][0]['rates'] ?? [];

                foreach ($ratesList as $item) {
                    $iso3 = $item['currency']['iso3'];
                    $name = $item['currency']['name'];
                    $unit = (int) $item['currency']['unit'];
                    $buy = (float) $item['buy'];
                    $sell = (float) $item['sell'];

                    $existing = FxRate::where('base_currency', $iso3)->first();
                    if ($existing && $existing->is_manual)
                        continue;

                    FxRate::updateOrCreate(
                        ['base_currency' => $iso3, 'target_currency' => 'NPR'],
                        [
                            'currency_name' => $name,
                            'unit' => $unit,
                            'buy_rate' => $buy,
                            'sell_rate' => $sell,
                            // Use sell_rate as the default 'rate' for overall compatibility
                            'rate' => $sell,
                            'fetched_at' => now(),
                            'is_manual' => false
                        ]
                    );
                }
                $this->info('NRB Forex sync complete.');
            } else {
                $this->warn('NRB API failed. Using fallback...');
                $this->fetchFxRatesFallback();
            }
        } catch (\Exception $e) {
            $this->error("Forex Sync Error: " . $e->getMessage());
            $this->fetchFxRatesFallback();
        }
    }

    private function fetchFxRatesFallback()
    {
        $this->info('Using ExchangeRate API (Fallback)...');
        $apiKey = config('services.exchangerate.key');
        if (!$apiKey)
            return;

        $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/USD");
        if ($response->successful()) {
            $rates = $response->json()['conversion_rates'];
            foreach (['USD', 'INR', 'EUR', 'GBP'] as $currency) {
                if (isset($rates[$currency])) {
                    FxRate::updateOrCreate(
                        ['base_currency' => $currency, 'target_currency' => 'NPR'],
                        ['rate' => $rates['NPR'] / $rates[$currency], 'fetched_at' => now(), 'is_manual' => false]
                    );
                }
            }
        }
    }

    private function fetchFuelPrices()
    {
        $this->info('Fetching fuel prices...');

        /**
         * NOTE: The Nepal Oil Corporation (NOC) does not provide an official JSON API.
         * The URLs below are unofficial mirrors. If they fail (e.g. DNS issues), 
         * the system automatically falls back to curated mock data to ensure the dashboard remains populated.
         * To update the source, change the URLs in the Http::get() calls below.
         */

        // Fetch Petrol
        $petrolResponse = Http::get("https://noc-api.ankurgajurel.com.np/petrol");
        if ($petrolResponse->successful()) {
            $data = $petrolResponse->json();
            foreach ($data as $item) {
                $region = $item['location'] ?? 'Nepal';
                $existing = FuelPrice::where('product', 'Petrol')->where('region', $region)->first();

                if ($existing && $existing->is_manual) {
                    $this->info("Skipping Petrol in {$region} (Manual Override)");
                    continue;
                }

                FuelPrice::updateOrCreate(
                    ['product' => 'Petrol', 'region' => $region],
                    [
                        'price' => $item['price'],
                        'unit' => 'Litre',
                        'currency' => 'NPR',
                        'fetched_at' => now(),
                        'is_manual' => false
                    ]
                );
            }
            $this->info('Petrol prices updated.');
        }

        // Fetch Diesel
        $dieselResponse = Http::get("https://noc-api.ankurgajurel.com.np/diesel");
        if ($dieselResponse->successful()) {
            $data = $dieselResponse->json();
            foreach ($data as $item) {
                $region = $item['location'] ?? 'Nepal';
                $existing = FuelPrice::where('product', 'Diesel')->where('region', $region)->first();

                if ($existing && $existing->is_manual) {
                    $this->info("Skipping Diesel in {$region} (Manual Override)");
                    continue;
                }

                FuelPrice::updateOrCreate(
                    ['product' => 'Diesel', 'region' => $region],
                    [
                        'price' => $item['price'],
                        'unit' => 'Litre',
                        'currency' => 'NPR',
                        'fetched_at' => now(),
                        'is_manual' => false
                    ]
                );
            }
            $this->info('Diesel prices updated.');
        }

        // Handle LPG, Kerosene, and Aviation Fuel (using sample data or mirrors)
        $this->handleExtraFuels();
    }

    private function handleExtraFuels()
    {
        $products = [
            'LPG' => ['price' => 1910.00, 'unit' => 'Cylinder'],
            'Kerosene' => ['price' => 141.00, 'unit' => 'Litre'],
            'Aviation Fuel Jet' => ['price' => 134.00, 'unit' => 'Litre'],
            'Aviation Fuel Duty Free' => ['price' => 1015.00, 'unit' => 'KL', 'currency' => 'USD'],
        ];

        $regions = ['Surkhet', 'Dang', 'Kathmandu'];

        foreach ($regions as $region) {
            foreach ($products as $product => $info) {
                $existing = FuelPrice::where('product', $product)->where('region', $region)->first();
                if ($existing && $existing->is_manual)
                    continue;

                FuelPrice::updateOrCreate(
                    ['product' => $product, 'region' => $region],
                    [
                        'price' => $info['price'],
                        'unit' => $info['unit'],
                        'currency' => $info['currency'] ?? 'NPR',
                        'fetched_at' => now(),
                        'is_manual' => false
                    ]
                );
            }
        }
        $this->info('Extra fuel products updated.');
    }

    private function fetchMetalPrices()
    {
        $this->info('Fetching metal prices...');
        $apiKey = config('services.goldapi.key');

        if (!$apiKey) {
            $this->warn('GoldAPI key missing. Skipping...');
            return;
        }

        $usdToNpr = FxRate::where('target_currency', 'NPR')->latest()->first();
        $conversionRate = $usdToNpr ? $usdToNpr->rate : 133.50;

        $response = Http::withHeaders([
            'x-access-token' => $apiKey,
            'Content-Type' => 'application/json'
        ])->get("https://www.goldapi.io/api/XAU/USD");

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['price'])) {
                $pricePerGramUsd = $data['price'] / 31.1035;
                $pricePerTolaUsd = $pricePerGramUsd * 11.6638;
                $pricePerTolaNpr = $pricePerTolaUsd * $conversionRate;

                $existing = MetalPrice::where('metal_type', 'Gold (24K)')->first();
                if (!$existing || !$existing->is_manual) {
                    $karats = [
                        'Gold (24K)' => 1.0,
                        'Gold (22K)' => 22 / 24,
                        'Gold (18K)' => 18 / 24,
                        'Gold (14K)' => 14 / 24,
                    ];

                    foreach ($karats as $label => $ratio) {
                        MetalPrice::updateOrCreate(
                            ['metal_type' => $label],
                            [
                                'price' => round($pricePerTolaNpr * $ratio, 2),
                                'unit' => 'Tola',
                                'currency' => 'NPR',
                                'fetched_at' => now(),
                                'is_manual' => false
                            ]
                        );
                    }
                    $this->info('Gold Karat prices updated.');
                } else {
                    $this->info('Skipping Gold (Manual Override)');
                }
            }

            $silverResponse = Http::withHeaders([
                'x-access-token' => $apiKey,
                'Content-Type' => 'application/json'
            ])->get("https://www.goldapi.io/api/XAG/USD");

            if ($silverResponse->successful()) {
                $silverData = $silverResponse->json();
                if (isset($silverData['price'])) {
                    $sPricePerGramUsd = $silverData['price'] / 31.1035;
                    $sPricePerTolaUsd = $sPricePerGramUsd * 11.6638;
                    $sPricePerTolaNpr = $sPricePerTolaUsd * $conversionRate;

                    $existingS = MetalPrice::where('metal_type', 'Silver')->first();
                    if (!$existingS || !$existingS->is_manual) {
                        MetalPrice::updateOrCreate(
                            ['metal_type' => 'Silver'],
                            [
                                'price' => round($sPricePerTolaNpr, 2),
                                'unit' => 'Tola',
                                'currency' => 'NPR',
                                'fetched_at' => now(),
                                'is_manual' => false
                            ]
                        );
                        $this->info('Silver price updated.');
                    } else {
                        $this->info('Skipping Silver (Manual Override)');
                    }
                }
            }
        }
    }

    private function mockFuelPrices()
    {
        $this->info('Using mock fuel prices as fallback...');
        $regions = ['Kathmandu', 'Pokhara', 'Biratnagar', 'Nepalgunj'];
        foreach ($regions as $region) {
            foreach (['Petrol', 'Diesel'] as $product) {
                $existing = FuelPrice::where('product', $product)->where('region', $region)->first();
                if ($existing && $existing->is_manual)
                    continue;

                FuelPrice::updateOrCreate(
                    ['product' => $product, 'region' => $region],
                    [
                        'price' => ($product == 'Petrol' ? 172.00 : 160.00) + rand(-2, 2),
                        'unit' => 'Litre',
                        'currency' => 'NPR',
                        'fetched_at' => now(),
                        'is_manual' => false
                    ]
                );
            }
        }
    }

    private function checkElectricity()
    {
        $existing = ElectricityTariff::where('category', 'Domestic')->where('slab', '0-20 Units')->first();
        if (!$existing) {
            ElectricityTariff::create([
                'category' => 'Domestic',
                'slab' => '0-20 Units',
                'rate' => 3.00,
                'fetched_at' => now(),
                'is_manual' => false
            ]);
            $this->info('Electricity Tariffs initialized.');
        }
    }
}
