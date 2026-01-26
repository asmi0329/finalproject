<x-guest-layout>
    <div class="mb-10 text-center">
        <h2
            class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight mb-2">
            Join NepaRates</h2>
        <p class="text-slate-600 font-medium">Create your account to access market data.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" placeholder="Radhe Radhe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-rose-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-6 space-y-2">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600" />
        </div>

        <!-- Password -->
        <div class="mt-6 space-y-2">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required
                autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6 space-y-2">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation"
                required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-rose-600" />
        </div>

        <div class="mt-10">
            <x-primary-button class="w-full">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <p class="mt-8 text-center text-sm font-medium text-slate-500">
            Already have an account?
            <a href="{{ route('login') }}"
                class="text-emerald-600 font-bold hover:text-emerald-700 hover:underline px-2">Log In</a>
        </p>
    </form>
</x-guest-layout>