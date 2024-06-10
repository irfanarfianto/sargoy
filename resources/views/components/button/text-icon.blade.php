@props([
    'size' => 'md',
    'icon' => null,
])

@php
    $classes = match ($size) {
        'sm' => 'py-2 px-3 text-xs', // Small size
        'md' => 'py-2.5 px-5 text-sm', // Medium size (default)
        'lg' => 'py-3 px-6 text-lg', // Large size
    };

    $classes .=
        ' font-medium text-gray-900 focus:outline-none rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700';
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
    @if ($icon)
        <i class="{{ $icon }} me-2"></i>
    @endif
    {{ $slot }}
</button>
