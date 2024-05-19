<!-- Tombol untuk membuka modal -->
<x-button.primary data-modal-target="crud-modal" data-modal-toggle="crud-modal"
    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button">
    Tambah FAQs baru
</x-button.primary>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New FAQs
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <x-label.input class="block text-gray-700 text-sm font-bold mb-2" for="pertanyaan">
                        Pertanyaan
                    </x-label.input>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 border-gray-300 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="pertanyaan" type="text" placeholder="Masukkan pertanyaan" name="pertanyaan">
                </div>
                <div class="mb-4">
                    <x-label.input class="block text-gray-700 text-sm font-bold mb-2" for="jawaban">
                        Jawaban
                    </x-label.input>
                    <textarea
                        class="block p-2.5 w-full h-36 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="jawaban" placeholder="Masukkan jawaban" name="jawaban"></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($faqs as $index => $faq)
    <!-- Main modal -->
    <div id="edit-modal-{{ $index }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit FAQs
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-modal-{{ $index }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('faqs.update', $faq->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <x-label.input class="block text-gray-700 text-sm font-bold mb-2" for="pertanyaan">
                            Pertanyaan
                        </x-label.input>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 border-gray-300 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="pertanyaan" type="text" placeholder="Masukkan pertanyaan" name="pertanyaan"
                            value="{{ $faq->pertanyaan }}">
                    </div>
                    <div class="mb-4">
                        <x-label.input class="block text-gray-700 text-sm font-bold mb-2" for="jawaban">
                            Jawaban
                        </x-label.input>
                        <textarea
                            class="block p-2.5 w-full h-36 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="jawaban" placeholder="Masukkan jawaban" name="jawaban">{{ $faq->jawaban }}</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <x-button.primary
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Submit
                        </x-button.primary>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete modal -->
    <div id="delete-modal-{{ $index }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Delete FAQ
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="delete-modal-{{ $index }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="mb-4">Are you sure you want to delete this FAQ?</p>
                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end">
                            <x-button.danger type="submit" class="me-2">
                                Delete
                            </x-button.danger>

                            <x-button.secondary data-modal-hide="popup-modal">
                                Cancel
                            </x-button.secondary>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
