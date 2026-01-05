<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Weather Monitoring</h1>
                    <p class="text-slate-400 mt-1">Live snapshots and historical weather data for major Nepali cities.
                    </p>
                </div>
                <a href="{{ route('admin.weather-snapshots.create') }}"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Snapshot
                </a>
            </div>

            @if(session('success'))
                <div
                    class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="admin-card overflow-hidden">
                <table class="w-full text-left datatable">
                    <thead
                        class="bg-slate-800/50 text-[10px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Condition</th>
                            <th class="px-6 py-4 text-center">Temp (C)</th>
                            <th class="px-6 py-4 text-center">Humidity</th>
                            <th class="px-6 py-4 text-center">Wind</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @foreach ($weatherSnapshots as $weather)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 font-bold text-white">{{ $weather->location }}</td>
                                <td class="px-6 py-4 text-slate-400">{{ $weather->condition }}</td>
                                <td class="px-6 py-4 text-center font-black text-indigo-400">{{ $weather->temperature_c }}°
                                </td>
                                <td class="px-6 py-4 text-center text-slate-500">{{ $weather->humidity }}%</td>
                                <td class="px-6 py-4 text-center text-slate-500">{{ $weather->wind_kph }} km/h</td>
                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="{{ route('admin.weather-snapshots.edit', $weather) }}"
                                        class="text-indigo-400 hover:text-indigo-300 font-bold uppercase text-xs">Edit</a>
                                    <form action="{{ route('admin.weather-snapshots.destroy', $weather) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Archive this snapshot?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-rose-500 hover:text-rose-400 font-bold uppercase text-xs">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>