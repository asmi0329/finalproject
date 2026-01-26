<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Register Operator</h1>
                    <p class="text-slate-400 mt-1">Create a new administrative account with specific data management
                        privileges.</p>
                </div>
                <a href="{{ route('admin.users.index') }}"
                    class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Registry
                </a>
            </div>

            <div class="admin-card p-8">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Legal
                            Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Asmita Giri"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600"
                            required>
                        @error('name') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label
                            class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Corporate
                            Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="operator@nepalrates.com"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600"
                            required>
                        @error('email') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Secure
                                Password</label>
                            <input type="password" name="password"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                required>
                            @error('password') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Confirm
                                Authorization</label>
                            <input type="password" name="password_confirmation"
                                class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                required>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Administrative
                            Role</label>
                        <select name="role" required
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Standard Operator (View
                                Only)</option>
                            <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Rate Editor (Full CRUD)
                            </option>
                        </select>
                        @error('role') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/20 uppercase tracking-widest text-sm">
                            Provision Operator Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>