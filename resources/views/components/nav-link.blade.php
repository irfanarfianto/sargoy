@props(['active' => false])

@php
    $classes = $active
            ? 'block text-blue-500 md:text-blue-500 md:p-0 dark:text-white md:dark:text-blue-500 transition duration-150 ease-in-out'
            : 'text-gray-900 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
