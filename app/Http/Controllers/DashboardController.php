<?php

namespace App\Http\Controllers;

use App\Models\FuelPrice;
use App\Models\ElectricityTariff;
use App\Models\FxRate;
use App\Models\WeatherSnapshot;
use App\Models\MetalPrice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $location = request('location');

        $fuelQuery = FuelPrice::latest('fetched_at');
        $electricityQuery = ElectricityTariff::latest('fetched_at');
        $weatherQuery = WeatherSnapshot::latest('fetched_at');
        $metalQuery = MetalPrice::latest('fetched_at');

        if ($location) {
            // Assuming these models might have or will have a location field or similar
            // For now, WeatherSnapshot definitely has location.
            // FuelPrice usually is national or city based. Let's try to filter if column exists
            $weatherQuery->where('location', 'like', "%{$location}%");
            $fuelQuery->where('region', 'like', "%{$location}%");
        }

        // Logic to get latest record for each distinct product/region/category
        $data = [
            'fuelPrices' => FuelPrice::whereIn('id', function ($query) use ($location) {
                $q = $query->selectRaw('max(id)')->from('fuel_prices')->groupBy('product', 'region');
                if ($location)
                    $q->where('region', 'like', "%{$location}%");
            })->get(),

            'electricityTariffs' => ElectricityTariff::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('electricity_tariffs')->groupBy('category', 'slab');
            })->get(),

            'fxRates' => FxRate::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('fx_rates')->where('target_currency', 'NPR')->groupBy('base_currency');
            })->get(),

            'weatherSnapshots' => WeatherSnapshot::whereIn('id', function ($query) use ($location) {
                $q = $query->selectRaw('max(id)')->from('weather_snapshots')->groupBy('location');
                if ($location)
                    $q->where('location', 'like', "%{$location}%");
            })->get(),

            'metalPrices' => MetalPrice::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('metal_prices')->groupBy('metal_type');
            })->get(),

            'searchLocation' => $location
        ];

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.dashboard', $data);
        }

        return view('dashboard', $data);
    }
}
