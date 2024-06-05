<a href="{{ $link }}">
    <div class="max-w-sm w-full  dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="overflow-hidden relative rounded-lg">
            <img class="w-54 h-54 object-cover transform transition-transform duration-500 ease-in-out hover:scale-110"
                src="{{ $image }}" alt="{{ $title }}" />
        </div>
        <div class="p-0">
            <h5 class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white line-clamp-1">
                {{ $title }}</h5>
            {{-- harga --}}
            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $price }}</p>
        </div>
    </div>
</a>
