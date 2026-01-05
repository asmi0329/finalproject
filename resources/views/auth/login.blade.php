<x-guest-layout>
    <div class="mb-10 text-center">
        <h2
            class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight mb-2">
            Welcome Back</h2>
        <p class="text-slate-600 font-medium">Please enter your credentials to access the rates.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600" />
        </div>

        <!-- Password -->
        <div class="mt-6 space-y-2">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full" type="password" name="password" required
                autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded-md border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500 h-5 w-5 transition-all"
                    name="remember">
                <span
                    class="ms-3 text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">{{ __('Stay Signed In') }}</span>
            </label>
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full">
                {{ __('Log In') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="mt-8 text-center text-sm font-medium text-slate-500">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="text-emerald-600 font-bold hover:text-emerald-700 hover:underline px-2">Create One</a>
            </p>
        @endif
    </form>
</x-guest-layout>