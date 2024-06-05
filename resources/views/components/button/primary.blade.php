<!-- resources/views/components/button/primary.blade.php -->
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'relative text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800']) }}>
    <span class="absolute inset-0 flex items-center justify-center hidden" id="loader">
        <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291l-1.71 1.71C6.322 20.963 8.074 22 10 22v-4a6 6 0 01-4-5.709z">
            </path>
        </svg>
    </span>
    <span id="button-text">{{ $slot }}</span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('button');
        button.addEventListener('click', function() {
            const loader = button.querySelector('#loader');
            const buttonText = button.querySelector('#button-text');

            loader.classList.remove('hidden');
            buttonText.classList.add('hidden');

            // Simulate a delay (e.g., an AJAX request)
            setTimeout(function() {
                loader.classList.add('hidden');
                buttonText.classList.remove('hidden');
            }, 3000); // Simulate 3 seconds delay
        });
    });
</script>
