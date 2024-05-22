<x-dashboard-layout>

    <h2 class="font-semibold mt-14 text-xl text-gray-800 leading-tight">
        {{ __('FAQs') }}
    </h2>

    <div class="container mx-auto max-w-screen-md justify-start px-4 py-8">
        @if (session('success'))
            <x-error.alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-error.alert type="danger" :message="session('error')" />
        @endif

        {{-- modal --}}
        @auth
            @if (auth()->user()->hasRole('admin'))
                @include('faqs.partials.modal')
            @endif
        @endauth
        <!-- Daftar FAQ -->
        <div id="accordion-flush" data-accordion="collapse"
            data-active-classes="bg-gray-300 dark:bg-gray-900 text-gray-900 dark:text-white"
            data-inactive-classes="text-gray-500 dark:text-gray-400">
            @foreach ($faqs as $index => $faq)
                <h2 id="accordion-flush-heading-{{ $index + 1 }}">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 mb-3 font-medium border border-b-0 border-gray-200 rounded-xl text-gray-500 hover:bg-gray-300 dark:border-gray-700 dark:text-gray-400 gap-3"
                        data-accordion-target="#accordion-flush-body-{{ $index + 1 }}" aria-expanded="false"
                        aria-controls="accordion-flush-body-{{ $index + 1 }}">
                        <span>{{ $faq->pertanyaan }}</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-{{ $index + 1 }}" class="hidden"
                    aria-labelledby="accordion-flush-heading-{{ $index + 1 }}">
                    <div class="p-5 border-r-l border-gray-300 bg-gray-100 dark:border-gray-700">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq->jawaban }}</p>
                        @if (auth()->user()->hasRole('admin'))
                            <div class="flex justify-end mt-3">
                                <!-- Tombol Edit -->
                                <button type="button" data-modal-toggle="edit-modal-{{ $index }}"
                                    data-modal-target="edit-modal-{{ $index }}"
                                    class="text-blue-600 dark:text-blue-500 hover:underline mr-3">Edit</button>
                                <!-- Form Delete -->
                                <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" data-modal-toggle="delete-modal-{{ $index }}"
                                        data-modal-target="delete-modal-{{ $index }}"
                                        data-modal-target="delete-modal-{{ $index }}"
                                        class="text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
