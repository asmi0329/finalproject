<x-user-dashboard-layout>
    @php
        $pageTitle = 'Foreign Exchange Rates';
        $pageDescription = 'Official foreign exchange rates from Nepal Rastra Bank';
    @endphp

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php $usd = $fxRates->firstWhere('base_currency', 'USD'); @endphp
        @php $eur = $fxRates->firstWhere('base_currency', 'EUR'); @endphp
        @php $gbp = $fxRates->firstWhere('base_currency', 'GBP'); @endphp
        @php $inr = $fxRates->firstWhere('base_currency', 'INR'); @endphp

        <div class="admin-card p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">USD</span>
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                    <span class="text-blue-600 font-black text-xl">$</span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $usd ? number_format($usd->buy_rate ?? $usd->rate, 2) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">US Dollar</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-indigo-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">EUR</span>
                <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">
                    <span class="text-indigo-600 font-black text-xl">€</span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $eur ? number_format($eur->buy_rate ?? $eur->rate, 2) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Euro</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-rose-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">GBP</span>
                <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center">
                    <span class="text-rose-600 font-black text-xl">£</span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $gbp ? number_format($gbp->buy_rate ?? $gbp->rate, 2) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">British Pound</span>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">INR</span>
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                    <span class="text-orange-600 font-black text-xl">₹</span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-3xl font-black text-slate-900">रु {{ $inr ? number_format($inr->buy_rate ?? $inr->rate, 2) : '--' }}</span>
                <span class="text-xs text-slate-500 font-bold mt-1 uppercase tracking-wider">Indian Rupee</span>
            </div>
        </div>
    </div>

    <!-- Currency Converter -->
    <div class="admin-card p-6 mb-8">
        <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 rounded bg-indigo-600 flex items-center justify-center">
                <span class="text-white text-sm">💱</span>
            </div>
            Quick Currency Converter
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Amount</label>
                <input type="number" id="convert_amount" value="1" 
                    class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-indigo-600 focus:border-indigo-600">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">From</label>
                <select id="convert_from" class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-indigo-600 focus:border-indigo-600">
                    @foreach($fxRates as $rate)
                        <option value="{{ $rate->buy_rate ?? $rate->rate }}">{{ $rate->base_currency }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">To</label>
                <select id="convert_to" class="w-full bg-white border-slate-200 text-slate-900 font-bold rounded-lg px-4 py-3 text-sm focus:ring-indigo-600 focus:border-indigo-600">
                    <option value="1">NPR (Nepali Rupee)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Result</label>
                <div class="w-full bg-indigo-50 border-2 border-indigo-200 text-indigo-900 font-black rounded-lg px-4 py-3 text-sm flex items-center justify-center">
                    <span id="convert_result">रु 0.00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Exchange Rates Table -->
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-black text-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-indigo-600 flex items-center justify-center">
                    <span class="text-white text-sm">रु</span>
                </div>
                Official Foreign Exchange Rates
            </h3>
            <p class="text-sm text-slate-500 mt-1">Daily exchange rates published by Nepal Rastra Bank (NRB)</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left datatable">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Currency</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Currency Name</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Unit</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Buy Rate</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Sell Rate</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Last Updated</th>
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
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $color }} flex items-center justify-center shadow-sm">
                                        <span class="text-white font-black text-xs">{{ substr($rate->base_currency, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-900 text-sm block">{{ $rate->base_currency }}</span>
                                        <span class="text-xs text-slate-500">{{ $rate->currency_name ?? '' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm">{{ $rate->currency_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-slate-600 font-semibold text-sm">{{ $rate->unit ?? 1 }}</td>
                            <td class="px-6 py-4 text-slate-900 font-bold text-sm">
                                रु {{ number_format($rate->buy_rate ?? $rate->rate, 2) }}
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-bold text-sm">
                                रु {{ number_format($rate->sell_rate ?? $rate->rate, 2) }}
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                {{ $rate->fetched_at ? \Carbon\Carbon::parse($rate->fetched_at)->format('M j, Y g:i A') : 'N/A' }}
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
                function updateConverter() {
                    const amount = parseFloat($('#convert_amount').val()) || 0;
                    const fromRate = parseFloat($('#convert_from').val()) || 0;
                    const toRate = parseFloat($('#convert_to').val()) || 1;
                    const result = (amount * fromRate) / toRate;
                    $('#convert_result').text('रु ' + result.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                }
                
                $('#convert_amount, #convert_from, #convert_to').on('input change', updateConverter);
                updateConverter();
            });
        </script>
    @endpush
</x-user-dashboard-layout>
