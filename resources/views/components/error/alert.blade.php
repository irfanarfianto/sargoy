<div class="flex items-center p-4 mb-4 text-sm rounded-lg {{ $type === 'success' ? 'text-green-800 border-green-300 bg-green-50' : ($type === 'info' ? 'text-blue-800 border-blue-300 bg-blue-50' : ($type === 'danger' ? 'text-red-800 border-red-300 bg-red-50' : ($type === 'warning' ? 'text-yellow-800 border-yellow-300 bg-yellow-50' : 'text-gray-800 border-gray-300 bg-gray-50'))) }} dark:text-{{ $type === 'dark' ? 'gray-300' : ($type === 'success' ? 'green-400' : ($type === 'info' ? 'blue-400' : ($type === 'danger' ? 'red-400' : ($type === 'warning' ? 'yellow-300' : 'gray-300')))) }} dark:bg-gray-800 dark:border-{{ $type === 'dark' ? 'gray-600' : ($type === 'success' ? 'green-800' : ($type === 'info' ? 'blue-800' : ($type === 'danger' ? 'red-800' : ($type === 'warning' ? 'yellow-800' : 'gray-600')))) }}">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">{{ ucfirst($type) }} Alert</span>
    <div>
        <span class="font-medium">{{ ucfirst($type) }} alert!</span> {{ $message }}
    </div>
</div>