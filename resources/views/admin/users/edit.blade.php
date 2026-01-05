<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Modify Operator Profile</h1>
                    <p class="text-slate-400 mt-1">Adjust administrative permissions for
                        <strong>{{ $user->name }}</strong>.</p>
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
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Legal
                            Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            required>
                        @error('name') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label
                            class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Corporate
                            Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            required>
                        @error('email') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-6 bg-amber-500/5 border border-amber-500/10 rounded-2xl">
                        <div
                            class="flex items-center gap-2 text-amber-400 text-[10px] font-black uppercase tracking-widest mb-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Security Override
                        </div>
                        <p class="text-slate-500 text-xs mb-6 leading-relaxed">Leave password fields empty to maintain
                            current credentials. Only provide a new password if a security reset is required.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">New
                                    Secure Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                @error('password') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Confirm
                                    Override</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-slate-500 font-black mb-2">Access
                            Privilege Level</label>
                        <select name="role" required
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Standard
                                Operator (View Only)</option>
                            <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>Rate
                                Editor (Full CRUD)</option>
                        </select>
                        @error('role') <p class="mt-2 text-xs text-rose-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/20 uppercase tracking-widest text-sm">
                            Commit Profile Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>