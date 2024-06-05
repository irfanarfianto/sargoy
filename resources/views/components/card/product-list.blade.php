<div class="flex w-full overflow-hidden items-start">
    <div class="overflow-hidden relative">
        <a href="{{ $link }}">
            <img class="rounded-lg h-48  object-cover transform transition-transform duration-500 ease-in-out hover:scale-110"
                src="{{ $image }}" alt="{{ $title }}" />
        </a>
    </div>
    <div class="p-5">
        <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2">
            {{ $title }}</h5>
        {{-- harga --}}
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ $price }}</p>

        <a href="{{ $link }}">
            <x-button.secondary class="mt-4">Detail</x-button.secondary>
        </a>
    </div>
</div>
