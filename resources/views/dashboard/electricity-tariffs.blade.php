<x-user-dashboard-layout>
    @php
        $pageTitle = 'Electricity Tariffs';
        $pageDescription = 'Current electricity tariff rates for different consumer categories';
    @endphp

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php 
            $residential = $electricityTariffs->where('category', 'Residential')->first();
            if (!$residential) $residential = $electricityTariffs->where('category', 'Domestic')->first();
        @endphp
        @php $commercial = $electricityTariffs->firstWhere('category', 'Commercial'); @endphp
        @php $industrial = $electricityTariffs->firstWhere('category', 'Industrial'); @endphp
        @php $agricultural = $electricityTariffs->firstWhere('category', 'Agricultural'); @endphp

        <div class="admin-card p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Residential</span>
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $residential ? number_format($residential->rate, 2) : '8.50' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per kWh</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Commercial</span>
                <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $commercial ? number_format($commercial->rate, 2) : '11.50' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per kWh</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Industrial</span>
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $industrial ? number_format($industrial->rate, 2) : '9.80' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per kWh</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Agricultural</span>
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $agricultural ? number_format($agricultural->rate, 2) : '5.50' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per kWh</span>
            </div>
        </div>
    </div>

    <!-- Electricity Calculator -->
    <div class="admin-card p-6 mb-8">
        <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 rounded bg-yellow-500 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            Electricity Bill Calculator
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Units Consumed</label>
                <input type="number" id="electricity_units" value="150" 
                    class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-yellow-600 focus:border-yellow-600">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Consumer Type</label>
                <select id="consumer_type" class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-yellow-600 focus:border-yellow-600">
                    <option value="residential">Residential</option>
                    <option value="commercial">Commercial</option>
                    <option value="industrial">Industrial</option>
                    <option value="agricultural">Agricultural</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Average Rate</label>
                <div class="w-full bg-yellow-50 border-2 border-yellow-200 text-yellow-900 font-black rounded-lg px-4 py-3 text-sm flex items-center justify-center">
                    <span id="avg_rate">रु 0.00</span>
                </div>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Estimated Bill</label>
                <div class="w-full bg-yellow-50 border-2 border-yellow-200 text-yellow-900 font-black rounded-lg px-4 py-3 text-sm flex items-center justify-center">
                    <span id="electricity_bill">रु 0.00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Electricity Tariffs Table -->
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-black text-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-yellow-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                Complete Electricity Tariff Structure
            </h3>
            <p class="text-sm text-slate-500 mt-1">Current electricity rates approved by Nepal Electricity Authority</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left datatable">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Consumer Type</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Slab/Range</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Unit</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">Rate (NPR)</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Service Charge</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Last Updated</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($electricityTariffs as $tariff)
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
                            <td class="px-6 py-4 text-slate-600 text-sm">{{ $tariff->consumer_type ?? 'General' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[9px] font-black rounded uppercase border border-slate-200">{{ $tariff->slab ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase border border-slate-200">{{ $tariff->unit ?? 'kWh' }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-black text-slate-900 text-sm">
                                रु {{ number_format($tariff->rate ?? 0, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-600 text-sm">
                                @if($tariff->service_charge)
                                    रु {{ number_format($tariff->service_charge, 2) }}
                                @else
                                    <span class="text-slate-400">--</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                {{ $tariff->fetched_at ? \Carbon\Carbon::parse($tariff->fetched_at)->format('M j, Y g:i A') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Get actual rates from the database
                const rateData = {
                    residential: { avg: {{ $residential ? $residential->rate : 8.50 }}, service: 50 },
                    commercial: { avg: {{ $commercial ? $commercial->rate : 11.50 }}, service: 200 },
                    industrial: { avg: {{ $industrial ? $industrial->rate : 9.80 }}, service: 400 },
                    agricultural: { avg: {{ $agricultural ? $agricultural->rate : 5.50 }}, service: 30 }
                };

                function updateElectricityCalc() {
                    const units = parseFloat($('#electricity_units').val()) || 0;
                    const type = $('#consumer_type').val();
                    const rates = rateData[type] || rateData.residential;
                    
                    const avgRate = rates.avg;
                    const serviceCharge = rates.service;
                    const totalBill = (units * avgRate) + serviceCharge;
                    
                    $('#avg_rate').text('रु ' + avgRate.toFixed(2));
                    $('#electricity_bill').text('रु ' + totalBill.toFixed(2));
                }
                
                $('#electricity_units, #consumer_type').on('input change', updateElectricityCalc);
                updateElectricityCalc();
            });
        </script>
    @endpush
</x-user-dashboard-layout>
