<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">User Administration</h1>
                    <p class="text-slate-400 mt-1">Manage system access, roles, and authorization status.</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Register New User
                </a>
            </div>

            <div class="admin-card overflow-hidden">
                <table class="w-full text-left datatable">
                    <thead
                        class="bg-slate-800/50 text-[10px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4">Identity</th>
                            <th class="px-6 py-4">Account Role</th>
                            <th class="px-6 py-4">Auth Status</th>
                            <th class="px-6 py-4">Created</th>
                            <th class="px-6 py-4 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach ($users as $user)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white">{{ $user->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2.5 py-1 bg-indigo-500/10 text-indigo-400 text-[10px] font-black rounded-lg uppercase tracking-wider border border-indigo-500/20">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_approved)
                                        <div
                                            class="inline-flex items-center gap-2 px-2.5 py-1 bg-emerald-500/10 text-emerald-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Verified
                                        </div>
                                    @else
                                        <div
                                            class="inline-flex items-center gap-2 px-2.5 py-1 bg-amber-500/10 text-amber-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-amber-500/20 shadow-[0_0_10px_rgba(245,158,11,0.1)]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending Audit
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-sm">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-4">
                                    @if(!$user->is_approved)
                                        <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-emerald-500 hover:text-emerald-400 text-xs font-bold uppercase transition-colors">Grant
                                                Access</button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="text-slate-400 hover:text-white text-xs font-bold uppercase transition-colors">Modify</a>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Account deletion is permanent. Proceed?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-rose-500/70 hover:text-rose-400 text-xs font-bold uppercase transition-colors">Terminate</button>
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