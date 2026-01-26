<x-user-dashboard-layout>
    @php
        $pageTitle = 'Fuel & LPG Prices';
        $pageDescription = 'Current fuel prices and LPG rates across Nepal';
    @endphp

    <!-- Search Bar -->
    <div class="mb-8">
        <form method="GET" action="{{ route('dashboard.fuel-lpg') }}" class="admin-card p-6">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="location" class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Filter by Region
                    </label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ $searchLocation ?? '' }}"
                        placeholder="Enter region (e.g., Kathmandu, Pokhara, Biratnagar...)"
                        class="w-full bg-white border-2 border-slate-200 text-slate-900 font-medium rounded-xl px-4 py-3 text-sm focus:ring-2 focus:rose-500 focus:border-rose-500 transition-all placeholder-slate-400"
                    >
                </div>
                <div class="flex gap-3">
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-rose-600 to-pink-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-wider hover:from-rose-700 hover:to-pink-700 active:from-rose-800 active:to-pink-800 focus:outline-none focus:ring-2 focus:ring-rose-500 transition-all duration-300 shadow-lg shadow-rose-500/20"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </button>
                    @if($searchLocation)
                        <a 
                            href="{{ route('dashboard.fuel-lpg') }}"
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
                <div class="mt-4 p-3 bg-rose-50 border border-rose-200 rounded-lg">
                    <p class="text-sm font-bold text-rose-800">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Showing results for: <span class="font-black">{{ $searchLocation }}</span>
                    </p>
                </div>
            @endif
        </form>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @php $petrol = $fuelPrices->firstWhere('product', 'Petrol'); @endphp
        @php $diesel = $fuelPrices->firstWhere('product', 'Diesel'); @endphp
        @php $lpg = $fuelPrices->firstWhere('product', 'Gas (LPG)'); @endphp

        <div class="admin-card p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Petrol</span>
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $petrol ? number_format($petrol->price) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per Liter</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Diesel</span>
                <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $diesel ? number_format($diesel->price) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per Liter</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-indigo-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">LPG Gas</span>
                <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" stroke-width="2" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $lpg ? number_format($lpg->price) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per 14.2kg Cylinder</span>
            </div>
        </div>
    </div>

    <!-- Detailed Fuel Prices Table -->
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-black text-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-rose-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" stroke-width="2" />
                    </svg>
                </div>
                Complete Fuel Price Registry
            </h3>
            <p class="text-sm text-slate-500 mt-1">Official NOC fuel prices across all regions of Nepal</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left datatable">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Product</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Regional Zone</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Unit</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">Current Rate</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Last Updated</th>
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
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase border border-slate-200">{{ $price->unit }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-black text-slate-900 text-sm">
                                रु {{ number_format($price->price) }}
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                {{ $price->fetched_at ? \Carbon\Carbon::parse($price->fetched_at)->format('M j, Y g:i A') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-user-dashboard-layout>
