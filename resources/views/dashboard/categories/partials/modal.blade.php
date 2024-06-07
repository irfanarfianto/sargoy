@foreach ($categories as $category)
    <!-- Modal Edit Kategori -->
    <div id="edit-category-modal-{{ $category->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Konten Modal -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Header Modal -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Kategori
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-category-modal-{{ $category->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <!-- Body Modal -->
                <div class="p-4 md:p-5 space-y-4">
                    <form id="edit-category-form-{{ $category->id }}" method="POST"
                        action="{{ route('dashboard.categories.update', ['category' => $category->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <div class="mb-4">
                                <x-label.input for="category_name" :value="__('Nama Kategori')" />
                                <x-input.text type="text" name="category_name" id="category_name"
                                    value="{{ old('category_name', $category->category_name) }}" required autofocus />
                                @error('category_name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-label.input for="meta_keyword" :value="__('Meta Keyword')" />
                            <x-input.text type="text" name="meta_keyword" id="meta_keyword"
                                value="{{ old('meta_keyword', $category->meta_keyword) }}" />
                            @error('meta_keyword')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <div class="mb-4">
                                <x-label.input for="images" :value="__('Gambar')" />
                                <span class="text-sm">Maksimal 2MB</span>
                                <x-input.text type="file" name="images" id="images"
                                    class="border border-gray-300" autofocus onchange="previewImage(this)">
                                </x-input.text>
                                @error('images')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            @if ($category->images)
                                <img src="{{ asset('storage/' . $category->images) }}" alt="Gambar Saat Ini"
                                    class="mt-2 h-24 w-24 object-cover">
                            @endif
                            @error('images')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </form>
                </div>
                <!-- Footer Modal -->
                <div
                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        onclick="document.getElementById('edit-category-form-{{ $category->id }}').submit();"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                        Perubahan</button>
                    <button data-modal-hide="edit-category-modal-{{ $category->id }}" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Kategori -->
    <div id="delete-category-modal-{{ $category->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Konten Modal -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Header Modal -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Konfirmasi Penghapusan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="delete-category-modal-{{ $category->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <!-- Body Modal -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Apakah Anda yakin ingin menghapus kategori <strong>{{ $category->category_name }}</strong>?
                    </p>
                </div>
                <!-- Footer Modal -->
                <div
                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form id="delete-category-form-{{ $category->id }}" method="POST"
                        action="{{ route('dashboard.categories.destroy', ['category' => $category->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus</button>
                    </form>
                    <button data-modal-hide="delete-category-modal-{{ $category->id }}" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
