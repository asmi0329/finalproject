<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Add Electricity Tariff</h1>
                    <p class="text-slate-400 mt-1">Configure a new billing slab for specific consumer categories.</p>
                </div>
                <a href="{{ route('admin.electricity-tariffs.index') }}"
                    class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Registry
                </a>
            </div>

            <div class="admin-card p-8">
                <form action="{{ route('admin.electricity-tariffs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Consumer
                                Category</label>
                            <input type="text" name="category" value="{{ old('category') }}"
                                placeholder="e.g. Domestic / Industrial"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600"
                                required>
                            @error('category') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Consumption
                                Slab</label>
                            <input type="text" name="slab" value="{{ old('slab') }}"
                                placeholder="e.g. 0-20 units / Single Phase"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600"
                                required>
                            @error('slab') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Energy
                            Rate (NPR/Unit)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold">Rs</span>
                            <input type="number" step="0.01" name="rate" value="{{ old('rate') }}"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl pl-12 pr-4 py-3 text-white font-black text-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                required>
                        </div>
                        @error('rate') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label
                            class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Effective
                            From</label>
                        <input type="datetime-local" name="fetched_at"
                            value="{{ old('fetched_at', now()->format('Y-m-d\TH:i')) }}"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        @error('fetched_at') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/20 uppercase tracking-widest text-sm">
                            Authorize & Publish Tariff
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>