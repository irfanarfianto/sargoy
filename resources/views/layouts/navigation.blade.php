<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex gap-3 justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
        <div class="flex-grow">
            <x-search-input action="" method="GET"></x-search-input>
        </div>
        <div class="flex items-center space-x-2">
            @if (Route::has('login'))
                @auth
                    <x-dropdown-user />
                @else
                    <x-nav-link href="{{ route('login') }}" class="font-bold">
                        {{ __('Masuk / Daftar') }}
                    </x-nav-link>

                @endauth
            @endif
        </div>
    </div>
</nav>
<nav class="bg-gray-50 dark:bg-gray-700">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center overflow-x-auto">
            <ul class="flex flex-row font-medium mt-0 space-x-8 text-sm">
                <li>
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="url('/produk')" :active="request()->is('/produk')">
                        {{ __('Produk') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="url('/edukasi')" :active="request()->is('/edukasi')">
                        {{ __('Edukasi') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="url('/tentang-kami')" :active="request()->is('/tentang-kami')">
                        {{ __('Tentang Kami') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="url('/tentang-kami')" :active="request()->is('/tentang-kami')">
                        {{ __('Tentang Kami') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="url('/tentang-kami')" :active="request()->is('/tentang-kami')">
                        {{ __('Tentang Kami') }}
                    </x-nav-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
