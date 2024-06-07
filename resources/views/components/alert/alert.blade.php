<!-- resources/views/components/alert.blade.php -->
<div x-data="{ show: @entangle($attributes->wire('model')).defer }" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-10"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-10" x-init="setTimeout(() => show = false, 3000)"
    class="fixed bottom-5 right-5 bg-blue-500 text-white p-4 rounded-lg shadow-lg" style="display: none;"
    {{ $attributes }}>
    {{ $slot }}
</div>
   