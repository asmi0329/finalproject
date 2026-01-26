<x-user-dashboard-layout>
    @php
        $pageTitle = 'Weather Data';
        $pageDescription = 'Current weather conditions and forecasts across Nepal';
    @endphp

    <!-- Search Bar -->
    <div class="mb-8">
        <form method="GET" action="{{ route('dashboard.weather-data') }}" class="admin-card p-6">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="location" class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Filter by Location
                    </label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ $searchLocation ?? '' }}"
                        placeholder="Enter location (e.g., Kathmandu, Pokhara, Biratnagar...)"
                        class="w-full bg-white border-2 border-slate-200 text-slate-900 font-medium rounded-xl px-4 py-3 text-sm focus:ring-2 focus:sky-500 focus:border-sky-500 transition-all placeholder-slate-400"
                    >
                </div>
                <div class="flex gap-3">
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-sky-600 to-blue-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-wider hover:from-sky-700 hover:to-blue-700 active:from-sky-800 active:to-blue-800 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all duration-300 shadow-lg shadow-sky-500/20"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </button>
                    <button 
                        type="button"
                        onclick="refreshWeatherData()"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-wider hover:from-emerald-700 hover:to-teal-700 active:from-emerald-800 active:to-teal-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300 shadow-lg shadow-emerald-500/20"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Refresh Data
                    </button>
                    @if($searchLocation)
                        <a 
                            href="{{ route('dashboard.weather-data') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-slate-100 border border-slate-300 rounded-xl font-bold text-xs text-slate-700 uppercase tracking-wider hover:bg-slate-200 active:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-400 transition-all duration-300"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Clear
                        </a>
                    @endif
                </div>
            </div>
            @if($searchLocation)
                <div class="mt-4 p-3 bg-sky-50 border border-sky-200 rounded-lg">
                    <p class="text-sm font-bold text-sky-800">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Showing results for: <span class="font-black">{{ $searchLocation }}</span>
                    </p>
                </div>
            @endif
        </form>
    </div>

    <!-- Weather Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php $kathmandu = $weatherSnapshots->firstWhere('location', 'Kathmandu'); @endphp
        @php $pokhara = $weatherSnapshots->firstWhere('location', 'Pokhara'); @endphp
        @php $biratnagar = $weatherSnapshots->firstWhere('location', 'Biratnagar'); @endphp
        @php $chitwan = $weatherSnapshots->firstWhere('location', 'Chitwan'); @endphp

        <div class="admin-card p-6 border-l-4 border-sky-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Kathmandu</span>
                @php
                    $condition = strtolower($kathmandu->condition ?? 'clear');
                    $isRainy = str_contains($condition, 'rain') || str_contains($condition, 'rainy');
                    $isCloudy = str_contains($condition, 'cloud') || str_contains($condition, 'overcast');
                @endphp
                <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center">
                    @if($isRainy)
                        <svg class="w-5 h-5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z M8 19v2m8-2v2m-4-2v2" />
                        </svg>
                    @elseif($isCloudy)
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @endif
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">{{ $kathmandu->temperature_c ?? '--' }}°C</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">{{ ucfirst($kathmandu->condition ?? 'Clear') }}</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Pokhara</span>
                @php
                    $condition = strtolower($pokhara->condition ?? 'clear');
                    $isRainy = str_contains($condition, 'rain') || str_contains($condition, 'rainy');
                    $isCloudy = str_contains($condition, 'cloud') || str_contains($condition, 'overcast');
                @endphp
                <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center">
                    @if($isRainy)
                        <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z M8 19v2m8-2v2m-4-2v2" />
                        </svg>
                    @elseif($isCloudy)
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @endif
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">{{ $pokhara->temperature_c ?? '--' }}°C</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">{{ ucfirst($pokhara->condition ?? 'Clear') }}</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Biratnagar</span>
                @php
                    $condition = strtolower($biratnagar->condition ?? 'clear');
                    $isRainy = str_contains($condition, 'rain') || str_contains($condition, 'rainy');
                    $isCloudy = str_contains($condition, 'cloud') || str_contains($condition, 'overcast');
                @endphp
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                    @if($isRainy)
                        <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z M8 19v2m8-2v2m-4-2v2" />
                        </svg>
                    @elseif($isCloudy)
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @endif
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">{{ $biratnagar->temperature_c ?? '--' }}°C</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">{{ ucfirst($biratnagar->condition ?? 'Clear') }}</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Chitwan</span>
                @php
                    $condition = strtolower($chitwan->condition ?? 'clear');
                    $isRainy = str_contains($condition, 'rain') || str_contains($condition, 'rainy');
                    $isCloudy = str_contains($condition, 'cloud') || str_contains($condition, 'overcast');
                @endphp
                <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                    @if($isRainy)
                        <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z M8 19v2m8-2v2m-4-2v2" />
                        </svg>
                    @elseif($isCloudy)
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @endif
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">{{ $chitwan->temperature_c ?? '--' }}°C</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">{{ ucfirst($chitwan->condition ?? 'Clear') }}</span>
            </div>
        </div>
    </div>

    <!-- Detailed Weather Table -->
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-black text-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-sky-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                Complete Weather Data
            </h3>
            <p class="text-sm text-slate-500 mt-1">Current weather conditions across major cities in Nepal</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left datatable">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Location</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Condition</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Temperature</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Humidity</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Wind Speed</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Pressure</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Last Updated</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($weatherSnapshots as $weather)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        $condition = strtolower($weather->condition ?? 'clear');
                                        $isRainy = str_contains($condition, 'rain') || str_contains($condition, 'rainy');
                                        $isCloudy = str_contains($condition, 'cloud') || str_contains($condition, 'overcast');
                                        $isSunny = str_contains($condition, 'clear') || str_contains($condition, 'sunny');
                                    @endphp
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br 
                                        {{ $isRainy ? 'from-sky-400 to-sky-600' : ($isCloudy ? 'from-slate-400 to-slate-600' : 'from-amber-400 to-orange-500') }} flex items-center justify-center shadow-sm">
                                        @if($isRainy)
                                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z M8 19v2m8-2v2m-4-2v2" />
                                            </svg>
                                        @elseif($isCloudy)
                                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="font-bold text-slate-900 text-sm">{{ $weather->location }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-sky-100 text-sky-700 text-[9px] font-black rounded-full border border-sky-200">
                                    {{ ucfirst($weather->condition ?? 'Clear') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="font-black text-slate-900 text-lg">{{ $weather->temperature_c ?? '--' }}°C</span>
                                    @if($weather->temperature_f)
                                        <span class="text-xs text-slate-500">({{ $weather->temperature_f }}°F)</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($weather->humidity)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="font-semibold text-slate-700">{{ $weather->humidity }}%</span>
                                    </div>
                                @else
                                    <span class="text-slate-400">--</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($weather->wind_kph)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </div>
                                @else
                                    <span class="text-slate-400">--</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($weather->pressure)
                                    <span class="font-semibold text-slate-700">{{ $weather->pressure }} hPa</span>
                                @else
                                    <span class="text-slate-400">--</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                {{ $weather->fetched_at ? \Carbon\Carbon::parse($weather->fetched_at)->format('M j, Y g:i A') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function refreshWeatherData() {
            const button = event.target;
            const originalText = button.innerHTML;
            
            // Show loading state
            button.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>Refreshing...';
            button.disabled = true;
            
            // Make AJAX request to refresh weather data
            fetch('/api/weather/refresh', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload the page to show updated data
                    window.location.reload();
                } else {
                    alert('Failed to refresh weather data. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while refreshing weather data.');
            })
            .finally(() => {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }
    </script>
</x-user-dashboard-layout>
