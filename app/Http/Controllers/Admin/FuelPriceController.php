<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelPrice;
use Illuminate\Http\Request;

class FuelPriceController extends Controller
{
    public function index()
    {
        $fuelPrices = FuelPrice::latest()->get();
        return view('admin.fuel_prices.index', compact('fuelPrices'));
    }

    public function create()
    {
        return view('admin.fuel_prices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'price' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        FuelPrice::create($validated);

        return redirect()->route('admin.fuel-prices.index')
            ->with('success', 'Fuel Price created successfully.');
    }

    public function edit(FuelPrice $fuelPrice)
    {
        return view('admin.fuel_prices.edit', compact('fuelPrice'));
    }

    public function update(Request $request, FuelPrice $fuelPrice)
    {
        $validated = $request->validate([
            'product' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'price' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        $fuelPrice->update($validated);

        return redirect()->route('admin.fuel-prices.index')
            ->with('success', 'Fuel Price updated successfully.');
    }

    public function destroy(FuelPrice $fuelPrice)
    {
        $fuelPrice->delete();

        return redirect()->route('admin.fuel-prices.index')
            ->with('success', 'Fuel Price deleted successfully.');
    }
}
