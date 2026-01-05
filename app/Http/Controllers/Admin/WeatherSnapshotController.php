<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeatherSnapshot;
use Illuminate\Http\Request;

class WeatherSnapshotController extends Controller
{
    public function index()
    {
        $weatherSnapshots = WeatherSnapshot::latest()->get();
        return view('admin.weather_snapshots.index', compact('weatherSnapshots'));
    }

    public function create()
    {
        return view('admin.weather_snapshots.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'temperature_c' => 'required|numeric',
            'humidity' => 'required|integer',
            'wind_kph' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        WeatherSnapshot::create($validated);

        return redirect()->route('admin.weather-snapshots.index')
            ->with('success', 'Weather Snapshot created successfully.');
    }

    public function edit(WeatherSnapshot $weatherSnapshot)
    {
        return view('admin.weather_snapshots.edit', compact('weatherSnapshot'));
    }

    public function update(Request $request, WeatherSnapshot $weatherSnapshot)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'temperature_c' => 'required|numeric',
            'humidity' => 'required|integer',
            'wind_kph' => 'required|numeric',
            'fetched_at' => 'required|date',
        ]);

        $weatherSnapshot->update($validated);

        return redirect()->route('admin.weather-snapshots.index')
            ->with('success', 'Weather Snapshot updated successfully.');
    }

    public function destroy(WeatherSnapshot $weatherSnapshot)
    {
        $weatherSnapshot->delete();

        return redirect()->route('admin.weather-snapshots.index')
            ->with('success', 'Weather Snapshot deleted successfully.');
    }
}
