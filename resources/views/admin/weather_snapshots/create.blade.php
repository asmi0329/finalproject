<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Weather Entry</h1>
                    <p class="text-slate-400 mt-1">Record a manual atmospheric snapshot for a specific Nepali city.</p>
                </div>
                <a href="{{ route('admin.weather-snapshots.index') }}"
                    class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Registry
                </a>
            </div>

            <div class="admin-card p-8">
                <form action="{{ route('admin.weather-snapshots.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Target
                                Location</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                placeholder="e.g. Kathmandu / Pokhara"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600"
                                required>
                            @error('location') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Weather
                                Condition</label>
                            <input type="text" name="condition" value="{{ old('condition') }}"
                                placeholder="e.g. Sunny / Rainy / Cloudy"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600"
                                required>
                            @error('condition') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Temp
                                (°C)</label>
                            <input type="number" step="0.01" name="temperature_c" value="{{ old('temperature_c') }}"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                required>
                            @error('temperature_c') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Humidity
                                (%)</label>
                            <input type="number" step="1" name="humidity" value="{{ old('humidity') }}"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                required>
                            @error('humidity') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Wind
                                (km/h)</label>
                            <input type="number" step="0.01" name="wind_kph" value="{{ old('wind_kph') }}"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                required>
                            @error('wind_kph') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Recording
                            Timestamp</label>
                        <input type="datetime-local" name="fetched_at"
                            value="{{ old('fetched_at', now()->format('Y-m-d\TH:i')) }}"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        @error('fetched_at') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/20 uppercase tracking-widest text-sm">
                            Publish Atmospheric Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>