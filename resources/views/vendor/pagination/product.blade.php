@if ($paginator->hasPages())
    <div class="flex flex-row gap-x-1 items-center">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span>
            to <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span>
            of <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span> Entries
        </span>
        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            @if ($paginator->onFirstPage())
                <x-button.secondary disabled>
                    Prev
                </x-button.secondary>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">
                    <x-button.secondary class="hover:bg-gray-300">
                        Prev
                    </x-button.secondary>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">
                    <x-button.secondary class="hover:bg-gray-300">
                    Next
                </x-button.secondary>
                </a>
            @else
                <x-button.secondary disabled>
                    Next
                </x-button.secondary>
            @endif
        </div>
    </div>
@endif
