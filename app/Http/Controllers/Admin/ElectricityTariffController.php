<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ElectricityTariff;
use Illuminate\Http\Request;

class ElectricityTariffController extends Controller
{
    public function index()
    {
        $electricityTariffs = ElectricityTariff::latest()->get();
        return view('admin.electricity_tariffs.index', compact('electricityTariffs'));
    }

    public function create()
    {
        return view('admin.electricity_tariffs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'slab' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        ElectricityTariff::create($validated);

        return redirect()->route('admin.electricity-tariffs.index')
            ->with('success', 'Electricity Tariff created successfully.');
    }

    public function edit(ElectricityTariff $electricityTariff)
    {
        return view('admin.electricity_tariffs.edit', compact('electricityTariff'));
    }

    public function update(Request $request, ElectricityTariff $electricityTariff)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'slab' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        $electricityTariff->update($validated);

        return redirect()->route('admin.electricity-tariffs.index')
            ->with('success', 'Electricity Tariff updated successfully.');
    }

    public function destroy(ElectricityTariff $electricityTariff)
    {
        $electricityTariff->delete();

        return redirect()->route('admin.electricity-tariffs.index')
            ->with('success', 'Electricity Tariff deleted successfully.');
    }
}
