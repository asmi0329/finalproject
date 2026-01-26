<?php

namespace App\Http\Controllers;

use App\Models\FuelPrice;
use App\Models\ElectricityTariff;
use App\Models\FxRate;
use App\Models\WeatherSnapshot;
use App\Models\MetalPrice;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Get latest data for display on landing page
        $data = [
            'fuelPrices' => FuelPrice::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('fuel_prices')->groupBy('product', 'region');
            })->get(),

            'fxRates' => FxRate::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('fx_rates')->where('target_currency', 'NPR')->groupBy('base_currency');
            })->get(),

            'weatherSnapshots' => WeatherSnapshot::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('weather_snapshots')->groupBy('location');
            })->get(),

            'metalPrices' => MetalPrice::whereIn('id', function ($query) {
                $query->selectRaw('max(id)')->from('metal_prices')->groupBy('metal_type');
            })->get(),
        ];

        return view('landing', $data);
    }
}
