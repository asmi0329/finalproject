<x-user-dashboard-layout>
    @php
        $pageTitle = 'Metal Prices';
        $pageDescription = 'Current gold and silver bullion market prices in Nepal';
    @endphp

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @php $gold24k = $metalPrices->firstWhere('metal_type', 'Gold (24K)'); @endphp
        @php $silver = $metalPrices->firstWhere('metal_type', 'Silver'); @endphp
        @php $gold22k = $metalPrices->firstWhere('metal_type', 'Gold (22K)'); @endphp

        <div class="admin-card p-6 border-l-4 border-amber-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Gold (24K)</span>
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $gold24k ? number_format($gold24k->price) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per Tola</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-slate-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Silver</span>
                <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $silver ? number_format($silver->price) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per Tola</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-yellow-600">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Gold (22K)</span>
                <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $gold22k ? number_format($gold22k->price) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Per Tola</span>
            </div>
        </div>
    </div>

    <!-- Metal Calculator -->
    <div class="admin-card p-6 mb-8">
        <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 rounded bg-amber-500 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            Metal Price Calculator
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Quantity</label>
                <input type="number" id="metal_qty" value="1" step="0.1"
                    class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-amber-600 focus:border-amber-600">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Metal Type</label>
                <select id="metal_type" class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-amber-600 focus:border-amber-600">
                    @foreach($metalPrices as $price)
                        <option value="{{ $price->price }}">{{ $price->metal_type }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Unit</label>
                <select id="metal_unit" class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-amber-600 focus:border-amber-600">
                    <option value="1">Tola</option>
                    <option value="0.0116638">Gram</option>
                    <option value="0.116638">10 Grams</option>
                    <option value="0.58319">50 Grams</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Total Price</label>
                <div class="w-full bg-amber-50 border-2 border-amber-200 text-amber-900 font-black rounded-lg px-4 py-3 text-sm flex items-center justify-center">
                    <span id="metal_calc_result">रु 0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Metal Prices Table -->
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-black text-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-amber-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                Complete Bullion Market Prices
            </h3>
            <p class="text-sm text-slate-500 mt-1">Current gold and silver prices in Nepali market</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left datatable">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Metal Type</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Purity</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Unit</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">Price (NPR)</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">Price per Gram</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Last Updated</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($metalPrices as $price)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
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
                                        <p class="text-xs text-slate-500">{{ $isGold ? 'Gold' : 'Silver' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if(str_contains($price->metal_type, '24K'))
                                    <span class="px-2 py-1 bg-amber-100 text-amber-700 text-[9px] font-black rounded-full border border-amber-200">24K</span>
                                @elseif(str_contains($price->metal_type, '22K'))
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-[9px] font-black rounded-full border border-yellow-200">22K</span>
                                @elseif(str_contains($price->metal_type, '18K'))
                                    <span class="px-2 py-1 bg-orange-100 text-orange-700 text-[9px] font-black rounded-full border border-orange-200">18K</span>
                                @else
                                    <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[9px] font-black rounded-full border border-slate-200">Standard</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase border border-slate-200">{{ $price->unit }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-black text-slate-900 text-sm">
                                रु {{ number_format($price->price) }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-600 text-sm">
                                रु {{ number_format($price->price / 85.735, 2) }}
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

    @push('scripts')
        <script>
            $(document).ready(function() {
                function updateMetalCalc() {
                    const qty = parseFloat($('#metal_qty').val()) || 0;
                    const rate = parseFloat($('#metal_type').val()) || 0;
                    const unit = parseFloat($('#metal_unit').val()) || 1;
                    const result = qty * rate * unit;
                    $('#metal_calc_result').text('रु ' + Math.round(result).toLocaleString());
                }
                
                $('#metal_qty, #metal_type, #metal_unit').on('input change', updateMetalCalc);
                updateMetalCalc();
            });
        </script>
    @endpush
</x-user-dashboard-layout>
