<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-label.input for="email" :value="__('Email')" />
            <x-input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-error.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label.input for="password" :value="__('Password')" />

            <x-input.text id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-error.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <x-button.primary class="ms-3">
                {{ __('Masuk') }}
            </x-button.primary>
        </div>
        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('login.google') }}">
                <x-button.text-icon icon="fa-brands fa-google">
                    <strong>{{ __('Masuk dengan Google') }}</strong>
                </x-button.text-icon>
            </a>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="mt-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">{{ __('Belum mempunyai akun?') }} <a
                    href="{{ route('register') }}"
                    class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    {{ __('Daftar') }}
                </a></p>
        </div>
    @endif
</x-guest-layout>
