<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center py-2.5 px-5 text-center']) }}>
    {{ $slot }}
</button>
