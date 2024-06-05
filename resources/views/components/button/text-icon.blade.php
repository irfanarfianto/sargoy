<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700']) }}>
    @if (isset($icon))
        <i class="{{ $icon }} me-2"></i>
    @endif
    {{ $slot }}
</button>
