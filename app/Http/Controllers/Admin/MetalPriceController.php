<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetalPrice;
use Illuminate\Http\Request;

class MetalPriceController extends Controller
{
    public function index()
    {
        $metalPrices = MetalPrice::latest()->get();
        return view('admin.metal_prices.index', compact('metalPrices'));
    }

    public function create()
    {
        return view('admin.metal_prices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'metal_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'currency' => 'required|string|max:3',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        MetalPrice::create($validated);

        return redirect()->route('admin.metal-prices.index')
            ->with('success', 'Metal Price created successfully.');
    }

    public function edit(MetalPrice $metalPrice)
    {
        return view('admin.metal_prices.edit', compact('metalPrice'));
    }

    public function update(Request $request, MetalPrice $metalPrice)
    {
        $validated = $request->validate([
            'metal_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'currency' => 'required|string|max:3',
            'fetched_at' => 'required|date',
        ]);

        $validated['is_manual'] = true;
        $metalPrice->update($validated);

        return redirect()->route('admin.metal-prices.index')
            ->with('success', 'Metal Price updated successfully.');
    }

    public function destroy(MetalPrice $metalPrice)
    {
        $metalPrice->delete();

        return redirect()->route('admin.metal-prices.index')
            ->with('success', 'Metal Price deleted successfully.');
    }
}
