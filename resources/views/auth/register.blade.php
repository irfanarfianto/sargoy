<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-label.input for="name" :value="__('Nama')" />
            <x-input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-error.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label.input for="email" :value="__('Email')" />
            <x-input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-error.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label.input for="password" :value="__('Password')" />

            <x-input.text id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-error.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label.input for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-input.text id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-error.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button.primary class="ms-4">
                {{ __('Daftar') }}
            </x-button.primary>
        </div>
    </form>
    <div class="mt-6 text-center">
        <p class="text-gray-500 dark:text-gray-400">{{ __('Sudah mempunyai akun?') }} <a href="{{ route('login') }}"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                {{ __('Login') }}
            </a></p>
    </div>
</x-guest-layout>
