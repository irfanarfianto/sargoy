<a href="{{ $link }}">
    <div
        class="max-w-sm w-full bg-white border border-gray-200 hover:border-gray-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="overflow-hidden relative">
            <img class="rounded-t-lg w-full h-64 object-cover transform transition-transform duration-500 ease-in-out hover:scale-110"
                src="{{ $image }}" alt="{{ $title }}" />
        </div>
        <div class="p-5">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $title }}</h5>
            {{-- harga --}}
            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $price }}</p>
        </div>
    </div>
</a>
