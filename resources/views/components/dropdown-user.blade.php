@php
    $userName = Auth::user()->name;
    $initials = strtoupper(substr($userName, 0, 1));
@endphp

<button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
    class="flex items-center justify-between w-full text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
    <span class="hidden md:block">{{ $userName }}</span>
    <div class="flex items-center justify-center w-8 h-8 ml-2 bg-green-500 rounded-full text-white">
        {{ $initials }}
    </div>
</button>
<!-- Dropdown menu -->
<div id="dropdownNavbar"
    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
        @if (auth()->user()->hasRole('visitor'))
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ __('Profile') }}
                </a>
            </li>
        @endif
        @if (auth()->user()->hasRole('admin'))
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ __('Admin Dashboard') }}
                </a>
            </li>
        @elseif(auth()->user()->hasRole('seller'))
            <li>
                <a href="{{ route('seller.dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ __('Seller Dashboard') }}
                </a>
            </li>
        @endif
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
