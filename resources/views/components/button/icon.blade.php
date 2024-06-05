<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'text-sm p-2.5 text-gray-900 inline-flex items-center focus:outline-none bg-transparant rounded-full hover:bg-gray-300 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700']) }}>
    @if (isset($icon))
        <i class="{{ $icon }}"></i>
    @endif
</button>
