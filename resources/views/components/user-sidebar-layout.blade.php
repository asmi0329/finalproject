<div class="flex min-h-screen bg-slate-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 shadow-sm">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="p-6 border-b border-slate-200">
                <h1 class="text-xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">NR</span>
                    </div>
                    NepaRates
                </h1>
                <p class="text-xs text-slate-500 mt-1 font-medium">User Dashboard</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700 border-l-4 border-emerald-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <!-- Fuel & LPG -->
                <a href="{{ route('dashboard.fuel-lpg') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard.fuel-lpg') ? 'bg-rose-50 text-rose-700 border-l-4 border-rose-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    Fuel & LPG
                </a>

                <!-- Foreign Exchange -->
                <a href="{{ route('dashboard.foreign-exchange') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard.foreign-exchange') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Foreign Exchange
                </a>

                <!-- Metal Prices -->
                <a href="{{ route('dashboard.metal-prices') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard.metal-prices') ? 'bg-amber-50 text-amber-700 border-l-4 border-amber-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    Metal Prices
                </a>

                <!-- Weather Data -->
                <a href="{{ route('dashboard.weather-data') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard.weather-data') ? 'bg-sky-50 text-sky-700 border-l-4 border-sky-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                    Weather Data
                </a>

                <!-- Electricity Tariffs -->
                <a href="{{ route('dashboard.electricity-tariffs') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard.electricity-tariffs') ? 'bg-yellow-50 text-yellow-700 border-l-4 border-yellow-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Electricity Tariffs
                </a>
            </nav>

            <!-- User Profile Section -->
            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center gap-3 px-4 py-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="px-4">
                    <x-dropdown align="start" width="48">
                        <x-slot name="trigger">
                            <button class="w-full flex items-center justify-center px-3 py-2 bg-slate-100 border border-slate-300 rounded-lg text-xs font-bold text-slate-700 hover:bg-slate-200 transition-colors">
                                Account Settings
                                <svg class="ml-2 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile Settings
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-600">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
        <header class="bg-white border-b border-slate-200 shadow-sm">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">{{ $pageTitle ?? 'Dashboard' }}</h2>
                        <p class="text-sm text-slate-500 mt-1">{{ $pageDescription ?? 'Market rates and economic data overview' }}</p>
                    </div>
                    <div class="text-xs text-slate-400">
                        {{ now()->format('l, F j, Y') }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
</div>
