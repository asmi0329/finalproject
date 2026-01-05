<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Metal Pricing Registry</h1>
                    <p class="text-slate-400 mt-1">Manage gold, silver, and other precious metal rates for the Nepal
                        market.</p>
                </div>
                <a href="{{ route('admin.metal-prices.create') }}"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Metal Price
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
                            <th class="px-6 py-4">Metal Type</th>
                            <th class="px-6 py-4">Unit</th>
                            <th class="px-6 py-4">Price (NPR)</th>
                            <th class="px-6 py-4">Mode</th>
                            <th class="px-6 py-4">Last Sync</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @foreach ($metalPrices as $price)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 font-bold text-white">{{ $price->metal_type }}</td>
                                <td class="px-6 py-4 text-slate-400 uppercase tracking-widest text-[10px]">
                                    {{ $price->unit }}</td>
                                <td class="px-6 py-4 font-black text-indigo-400">Rs {{ number_format($price->price, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($price->is_manual)
                                        <span
                                            class="px-2 py-1 bg-amber-500/10 text-amber-500 text-[10px] font-bold rounded border border-amber-500/20 uppercase tracking-widest">Manual</span>
                                    @else
                                        <span
                                            class="px-2 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-bold rounded border border-emerald-500/20 uppercase tracking-widest">Automated</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">
                                    {{ $price->fetched_at ? $price->fetched_at->diffForHumans() : 'Never' }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="{{ route('admin.metal-prices.edit', $price) }}"
                                        class="text-indigo-400 hover:text-indigo-300 font-bold uppercase text-xs">Edit</a>
                                    <form action="{{ route('admin.metal-prices.destroy', $price) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Archive this metal price?');">
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