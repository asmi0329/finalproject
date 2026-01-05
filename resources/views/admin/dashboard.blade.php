<x-app-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-slate-900">Dashboard Overview</h1>
                <p class="text-sm text-slate-500 mt-1">Monitor and manage all market data</p>
            </div>
            <button onclick="location.reload()"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Refresh Data
            </button>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Fuel Products Card -->
            <div class="admin-card p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                stroke-width="2" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+2.5%</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900">{{ count($fuelPrices) }}</h3>
                <p class="text-sm text-slate-500 font-medium mt-1">Fuel Products</p>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.fuel-prices.index') }}"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                        View All
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Forex Pairs Card -->
            <div class="admin-card p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">NRB API</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900">{{ count($fxRates) }}</h3>
                <p class="text-sm text-slate-500 font-medium mt-1">Currency Pairs</p>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.fx-rates.index') }}"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                        Manage Rates
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Metal Prices Card -->
            <div class="admin-card p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-lg bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Live</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900">{{ count($metalPrices) }}</h3>
                <p class="text-sm text-slate-500 font-medium mt-1">Bullion Types</p>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.metal-prices.index') }}"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                        View Prices
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Users Card -->
            <div class="admin-card p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded-full">Active</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900">{{ \App\Models\User::count() }}</h3>
                <p class="text-sm text-slate-500 font-medium mt-1">System Users</p>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                        Manage Users
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Data -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Forex Rates -->
            <div class="lg:col-span-2 admin-card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-black text-slate-900">Latest Forex Rates</h2>
                    <a href="{{ route('admin.fx-rates.index') }}"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="text-left py-3 px-4 text-xs font-bold text-slate-500 uppercase">Currency</th>
                                <th class="text-right py-3 px-4 text-xs font-bold text-slate-500 uppercase">Buy</th>
                                <th class="text-right py-3 px-4 text-xs font-bold text-slate-500 uppercase">Sell</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fxRates->take(5) as $rate)
                                <tr class="border-b border-slate-50 hover:bg-slate-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-xs">
                                                {{ substr($rate->base_currency, 0, 2) }}
                                            </div>
                                            <span class="font-semibold text-slate-900">{{ $rate->base_currency }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-right font-bold text-slate-900">रु
                                        {{ number_format($rate->buy_rate ?? $rate->rate, 2) }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-slate-900">रु
                                        {{ number_format($rate->sell_rate ?? $rate->rate, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card p-6">
                <h2 class="text-lg font-black text-slate-900 mb-6">Quick Actions</h2>
                <div class="space-y-3">
                    <a href="{{ route('admin.fuel-prices.create') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-indigo-500 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center group-hover:bg-rose-500 transition-colors">
                            <svg class="w-5 h-5 text-rose-600 group-hover:text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 group-hover:text-indigo-700">Add Fuel
                            Price</span>
                    </a>

                    <a href="{{ route('admin.fx-rates.create') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-indigo-500 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-500 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600 group-hover:text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 group-hover:text-indigo-700">Add FX
                            Rate</span>
                    </a>

                    <a href="{{ route('admin.metal-prices.create') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-indigo-500 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center group-hover:bg-amber-500 transition-colors">
                            <svg class="w-5 h-5 text-amber-600 group-hover:text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 group-hover:text-indigo-700">Add Metal
                            Price</span>
                    </a>

                    <a href="{{ route('admin.users.create') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-indigo-500 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center group-hover:bg-indigo-500 transition-colors">
                            <svg class="w-5 h-5 text-indigo-600 group-hover:text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-700 group-hover:text-indigo-700">Add New
                            User</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Metal Prices -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Metal Prices -->
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-black text-slate-900">Bullion Market</h2>
                    <a href="{{ route('admin.metal-prices.index') }}"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">Manage</a>
                </div>
                <div class="space-y-4">
                    @foreach($metalPrices->take(4) as $metal)
                        <div
                            class="flex items-center justify-between p-4 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ $metal->metal_type }}</p>
                                    <p class="text-xs text-slate-500">Per {{ $metal->unit }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-900">रु {{ number_format($metal->price) }}</p>
                                <p class="text-xs text-emerald-600 font-semibold">+0.5%</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Status -->
            <div class="admin-card p-6">
                <h2 class="text-lg font-black text-slate-900 mb-6">System Status</h2>
                <div class="space-y-4">
                    <div
                        class="flex items-center justify-between p-4 rounded-lg bg-emerald-50 border border-emerald-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">NRB API</p>
                                <p class="text-xs text-slate-600">Forex Data Source</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-black text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">Connected</span>
                    </div>

                    <div class="flex items-center justify-between p-4 rounded-lg bg-blue-50 border border-blue-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Database</p>
                                <p class="text-xs text-slate-600">Data Storage</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-black text-blue-600 bg-blue-100 px-3 py-1 rounded-full">Operational</span>
                    </div>

                    <div class="flex items-center justify-between p-4 rounded-lg bg-indigo-50 border border-indigo-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Auto-Sync</p>
                                <p class="text-xs text-slate-600">Hourly Updates</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-black text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>