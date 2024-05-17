<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
        <div class="flex-grow">
            <x-search-input action="" method="GET"></x-search-input>
        </div>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            @if (Route::has('login'))
                @auth
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                        {{ Auth::user()->name }}
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar"
                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="block px-4 py-2 hover:bg-gray-100 hover:text-red-600 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('Keluar') }}
                                    </a>

                                </li>
                            </form>
                        </ul>
                    </div>
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
        <div class="flex items-center">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
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
            </ul>
        </div>
    </div>
</nav>
