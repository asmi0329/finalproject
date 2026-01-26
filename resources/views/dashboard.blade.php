<x-user-dashboard-layout>
    @php
        $pageTitle = 'Dashboard';
        $pageDescription = 'Market rates and economic data overview';
    @endphp

            <!-- Search Bar -->
            <div class="mb-8">
                <form method="GET" action="{{ route('dashboard') }}" class="admin-card p-6">
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
                                class="w-full bg-white border-2 border-slate-200 text-slate-900 font-medium rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all placeholder-slate-400"
                            >
                        </div>
                        <div class="flex gap-3">
                            <button 
                                type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-wider hover:from-emerald-700 hover:to-teal-700 active:from-emerald-800 active:to-teal-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300 shadow-lg shadow-emerald-500/20"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search
                            </button>
                            @if($searchLocation)
                                <a 
                                    href="{{ route('dashboard') }}"
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
                        <div class="mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                            <p class="text-sm font-bold text-emerald-800">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Showing results for: <span class="font-black">{{ $searchLocation }}</span>
                            </p>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Quick Market HUD -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- LPG Featured -->
                @php $lpg = $fuelPrices->firstWhere('product', 'Gas (LPG)'); @endphp
                <div class="admin-card p-6 border-l-4 border-indigo-600">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">LPG Gas
                            (14.2kg)</span>
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                    stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-slate-900">रु
                            {{ $lpg ? number_format($lpg->price) : '1,910' }}</span>
                        <span class="text-xs text-emerald-600 font-bold mt-1 uppercase tracking-wider">Official NOC
                            Rate</span>
                    </div>
                </div>

                <!-- Gold Featured -->
                @php $gold = $metalPrices->firstWhere('metal_type', 'Gold (24K)'); @endphp
                <div class="admin-card p-6 border-l-4 border-amber-500">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Gold (24K)</span>
                        <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-slate-900">रु
                            {{ $gold ? number_format($gold->price) : '--' }}</span>
                        <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per Tola</span>
                    </div>
                </div>

                <!-- USD Rate Featured -->
                @php $usd = $fxRates->firstWhere('base_currency', 'USD'); @endphp
                <div class="admin-card p-6 border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">USD to NPR</span>
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center">
                            <span class="text-emerald-600 font-black text-2xl">$</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-slate-900">रु
                            {{ $usd ? number_format($usd->buy_rate ?? $usd->rate, 2) : '--' }}</span>
                        <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">NRB Buy Rate</span>
                    </div>
                </div>

                <!-- Weather Card - Enhanced -->
                <div class="admin-card p-6 border-l-4 border-sky-500">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $weatherSnapshots->first()->location ?? 'Kathmandu' }}</span>
                        <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center">
                            @php
                                $condition = strtolower($weatherSnapshots->first()->condition ?? 'clear');
                                $isRainy = str_contains($condition, 'rain') || str_contains($condition, 'rainy');
                                $isCloudy = str_contains($condition, 'cloud') || str_contains($condition, 'overcast');
                            @endphp
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
                        <span class="text-3xl font-black text-slate-900">{{ $weatherSnapshots->first()->temperature_c ?? '--' }}°C</span>
                        <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">{{ $weatherSnapshots->first()->condition ?? 'Clear' }}</span>
                        @if($weatherSnapshots->first())
                            <div class="mt-3 pt-3 border-t border-slate-100 space-y-1">
                                @if($weatherSnapshots->first()->humidity)
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400">Humidity</span>
                                        <span class="font-bold text-slate-600">{{ $weatherSnapshots->first()->humidity }}%</span>
                                    </div>
                                @endif
                                @if($weatherSnapshots->first()->wind_speed)
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400">Wind</span>
                                        <span class="font-bold text-slate-600">{{ $weatherSnapshots->first()->wind_speed }} km/h</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Market Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Foreign Exchange Rates (NRB Format) -->
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-black text-slate-900 flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-indigo-600 flex items-center justify-center">
                                <span class="text-white text-sm">रु</span>
                            </div>
                            Official Foreign Exchange Rates
                        </h2>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Source: NRB</span>
                    </div>
                    <div class="admin-card overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Currency</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Unit</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Buy</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Sell</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($fxRates as $rate)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $currencyColors = [
                                                        'USD' => 'from-blue-500 to-blue-600',
                                                        'EUR' => 'from-indigo-500 to-indigo-600',
                                                        'GBP' => 'from-rose-500 to-rose-600',
                                                        'AUD' => 'from-emerald-500 to-emerald-600',
                                                        'JPY' => 'from-red-500 to-red-600',
                                                        'CNY' => 'from-amber-500 to-amber-600',
                                                        'INR' => 'from-orange-500 to-orange-600',
                                                        'SAR' => 'from-green-500 to-green-600',
                                                        'AED' => 'from-teal-500 to-teal-600',
                                                        'MYR' => 'from-yellow-500 to-yellow-600',
                                                        'THB' => 'from-purple-500 to-purple-600',
                                                    ];
                                                    $color = $currencyColors[$rate->base_currency] ?? 'from-slate-500 to-slate-600';
                                                @endphp
                                                <div
                                                    class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $color }} flex items-center justify-center shadow-sm">
                                                    <span
                                                        class="text-white font-black text-xs">{{ substr($rate->base_currency, 0, 2) }}</span>
                                                </div>
                                                <div>
                                                    <span
                                                        class="font-bold text-slate-900 text-sm block">{{ $rate->base_currency }}</span>
                                                    <span
                                                        class="text-xs text-slate-500">{{ $rate->currency_name ?? '' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 font-semibold text-sm">
                                            {{ $rate->unit ?? 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-slate-900 font-bold text-sm">
                                            रु {{ number_format($rate->buy_rate ?? $rate->rate, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-slate-900 font-bold text-sm">
                                            रु {{ number_format($rate->sell_rate ?? $rate->rate, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Precious Metals -->
                <div>
                    <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-amber-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-width="2" />
                            </svg>
                        </div>
                        Bullion Market
                    </h2>
                    <div class="admin-card divide-y divide-slate-100">
                        @foreach($metalPrices->take(6) as $price)
                            <div class="px-6 py-4 flex justify-between items-center group hover:bg-amber-50 transition-all">
                                <div class="flex items-center gap-3">
                                    @php
                                        $isGold = str_contains(strtolower($price->metal_type), 'gold');
                                        $isSilver = str_contains(strtolower($price->metal_type), 'silver');
                                    @endphp
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $isGold ? 'from-amber-400 to-amber-600' : 'from-slate-300 to-slate-500' }} flex items-center justify-center shadow-sm">
                                        @if($isGold)
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900">{{ $price->metal_type }}</p>
                                        <p class="text-xs text-slate-500">Per {{ $price->unit }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-slate-900 font-black text-sm">रु {{ number_format($price->price) }}</p>
                                </div>
                            </div>
                        @endforeach

                        <!-- Mini Gold Calculator -->
                        <div class="p-6 bg-slate-50/50">
                            <label
                                class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Tola
                                to NPR Calculator</label>
                            <div class="flex gap-2">
                                <input type="number" id="metal_qty" value="1"
                                    class="w-20 bg-white border-slate-200 text-slate-900 font-bold rounded-lg p-2 text-sm focus:ring-indigo-600 focus:border-indigo-600">
                                <select id="metal_type"
                                    class="flex-1 bg-white border-slate-200 text-slate-900 font-bold rounded-lg p-2 text-sm focus:ring-indigo-600 focus:border-indigo-600">
                                    @foreach($metalPrices as $price)
                                        <option value="{{ $price->price }}">{{ $price->metal_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4 p-4 bg-white rounded-lg text-center border border-slate-200 shadow-sm transition-all"
                                id="metal_res_box">
                                <p class="text-2xl font-black text-indigo-600" id="metal_res">रु
                                    {{ number_format($metalPrices->first()->price ?? 0) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Electricity Tariffs -->
                <div class="lg:col-span-2 mt-8">
                    <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-yellow-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        Electricity Tariffs
                    </h2>
                    <div class="admin-card overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Category</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Slab</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Unit</th>
                                    <th class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">Rate</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($electricityTariffs->take(8) as $tariff)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $category = strtolower($tariff->category ?? '');
                                                    if (str_contains($category, 'residential') || str_contains($category, 'domestic')) {
                                                        $color = 'from-blue-500 to-blue-600';
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>';
                                                    } elseif (str_contains($category, 'commercial') || str_contains($category, 'business')) {
                                                        $color = 'from-purple-500 to-purple-600';
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>';
                                                    } elseif (str_contains($category, 'industrial')) {
                                                        $color = 'from-orange-500 to-orange-600';
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" /></svg>';
                                                    } else {
                                                        $color = 'from-slate-500 to-slate-600';
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>';
                                                    }
                                                @endphp
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $color }} flex items-center justify-center shadow-sm">
                                                    {!! $icon !!}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-slate-900 text-sm block">{{ ucfirst($tariff->category) }}</span>
                                                    <span class="text-xs text-slate-500">{{ $tariff->consumer_type ?? 'Standard' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 font-semibold text-sm">{{ $tariff->slab ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase border border-slate-200">{{ $tariff->unit ?? 'kWh' }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-black text-slate-900 text-sm">रु {{ number_format($tariff->rate ?? 0, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Weather Snapshots -->
                <div class="mt-8">
                    <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-sky-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        Weather Snapshots
                    </h2>
                    <div class="admin-card divide-y divide-slate-100">
                        @foreach($weatherSnapshots->take(6) as $weather)
                            <div class="px-6 py-4 flex justify-between items-center group hover:bg-sky-50 transition-all">
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
                                    <div>
                                        <p class="text-xs font-bold text-slate-900">{{ $weather->location }}</p>
                                        <p class="text-xs text-slate-500">{{ ucfirst($weather->condition ?? 'Clear') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-slate-900 font-black text-sm">{{ $weather->temperature_c ?? '--' }}°C</p>
                                    @if($weather->humidity)
                                        <p class="text-xs text-slate-500">{{ $weather->humidity }}% humidity</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Petroleum Products Details -->
                <div class="lg:col-span-3 mt-8">
                    <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-rose-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                    stroke-width="2" />
                            </svg>
                        </div>
                        Fuel Price Registry (NOC)
                    </h2>
                    <div class="admin-card overflow-hidden">
                        <table class="w-full text-left datatable">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Product</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Regional Zone</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Unit</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        Current Rate</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($fuelPrices as $price)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $product = strtolower($price->product);
                                                    if (str_contains($product, 'lpg') || str_contains($product, 'gas')) {
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" stroke-width="2" /></svg>';
                                                        $color = 'from-indigo-500 to-indigo-600';
                                                    } elseif (str_contains($product, 'petrol')) {
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>';
                                                        $color = 'from-orange-500 to-orange-600';
                                                    } elseif (str_contains($product, 'diesel')) {
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>';
                                                        $color = 'from-emerald-500 to-emerald-600';
                                                    } elseif (str_contains($product, 'kerosene')) {
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>';
                                                        $color = 'from-blue-500 to-blue-600';
                                                    } else {
                                                        $icon = '<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" stroke-width="2" /></svg>';
                                                        $color = 'from-slate-500 to-slate-600';
                                                    }
                                                @endphp
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $color }} flex items-center justify-center shadow-sm">
                                                    {!! $icon !!}
                                                </div>
                                                <span class="font-bold text-slate-900 text-sm">{{ $price->product }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 text-sm font-medium">{{ $price->region }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase border border-slate-200">{{ $price->unit }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-black text-slate-900 text-sm">
                                            रु {{ number_format($price->price) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Footer Small -->
            <div
                class="mt-20 pt-10 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-6 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                <p>&copy; {{ date('Y') }} NepaRates Dashboard • Data via NRB & NOC</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-indigo-600 transition-colors">Forex Trends</a>
                    <a href="#" class="hover:text-amber-500 transition-colors">Bullion History</a>
                    <a href="#" class="hover:text-rose-600 transition-colors">Fuel Registry</a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                function updateMetalCalc() {
                    const qty = $('#metal_qty').val();
                    const rate = $('#metal_type').val();
                    const res = qty * rate;
                    $('#metal_res').text('रु ' + Math.round(res).toLocaleString());
                }
                $('#metal_qty, #metal_type').on('input change', updateMetalCalc);
            });
        </script>
    @endpush
</x-user-dashboard-layout>