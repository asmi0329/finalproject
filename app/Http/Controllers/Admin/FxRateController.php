<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FxRate;
use Illuminate\Http\Request;

class FxRateController extends Controller
{
    public function index()
    {
        $fxRates = FxRate::latest()->get();
        return view('admin.fx_rates.index', compact('fxRates'));
    }

    public function create()
    {
        return view('admin.fx_rates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'base_currency' => 'required|string|max:3',
            'currency_name' => 'nullable|string|max:255',
            'unit' => 'nullable|integer|min:1',
            'buy_rate' => 'nullable|numeric|min:0',
            'sell_rate' => 'nullable|numeric|min:0',
            'target_currency' => 'required|string|max:3',
            'rate' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        FxRate::create($validated);

        return redirect()->route('admin.fx-rates.index')
            ->with('success', 'FX Rate created successfully.');
    }

    public function edit(FxRate $fxRate)
    {
        return view('admin.fx_rates.edit', compact('fxRate'));
    }

    public function update(Request $request, FxRate $fxRate)
    {
        $validated = $request->validate([
            'base_currency' => 'required|string|max:3',
            'currency_name' => 'nullable|string|max:255',
            'unit' => 'nullable|integer|min:1',
            'buy_rate' => 'nullable|numeric|min:0',
            'sell_rate' => 'nullable|numeric|min:0',
            'target_currency' => 'required|string|max:3',
            'rate' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        $fxRate->update($validated);

        return redirect()->route('admin.fx-rates.index')
            ->with('success', 'FX Rate updated successfully.');
    }

    public function destroy(FxRate $fxRate)
    {
        $fxRate->delete();

        return redirect()->route('admin.fx-rates.index')
            ->with('success', 'FX Rate deleted successfully.');
    }
}
