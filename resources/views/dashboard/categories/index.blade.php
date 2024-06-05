<x-dashboard-layout>
    <h2 class="font-semibold mt-14 text-xl text-gray-800 leading-tight">
        {{ __('Kategori Produk') }}
    </h2>
    <div class="container mt-5 flex gap-2.5 flex-wrap-reverse mx-auto max-w-screen">
        <div class="w-full lg:w-4/6 rounded-lg overflow-x-auto">
            <form id="updatePositionForm" action="{{ route('categories.updatePosition') }}" method="POST">
                @csrf
                <ul id="sortableList" class="list-none p-0">
                    @foreach ($categories as $category)
                        <li data-id="{{ $category->id }}" class="border rounded p-4 mb-2 bg-white shadow-md">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <i class="fa-solid fa-grip-vertical cursor-move"></i>
                                    <div class="flex gap-x-1 items-center">
                                        @if ($category->images)
                                            <img src="{{ asset($category->images) }}"
                                                class="h-14 w-14 object-cover rounded-md mt-2" alt="Gambar">
                                        @else
                                            <span class="text-sm text-gray-500">Tidak Ada Gambar</span>
                                        @endif
                                        <div class="flex flex-col">
                                            <div class="font-bold">{{ $category->category_name }}</div>
                                            <div class="text-sm text-gray-600">{{ $category->meta_keyword }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <x-button.secondary data-modal-target="edit-category-modal-{{ $category->id }}"
                                        data-modal-toggle="edit-category-modal-{{ $category->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </x-button.secondary>
                                    <x-button.danger data-modal-target="delete-category-modal-{{ $category->id }}"
                                        data-modal-toggle="delete-category-modal-{{ $category->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </x-button.danger>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div id="saveChangesContainer" style="display: none;" class="mt-4">
                    <x-button.primary type="submit">
                        Simpan Perubahan
                    </x-button.primary>
                </div>
            </form>
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
        <div class="lg:w-1/4 rounded-lg w-full bg-white shadow-md p-4">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
                id="categoryForm">
                @csrf
                <div class="mb-4">
                    <x-label.input for="category_name" :value="__('Nama Kategori')" />
                    <x-input.text type="text" name="category_name" id="category_name" required autofocus />
                    @error('category_name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label.input for="position" :value="__('Urutan Posisi')" />
                    <x-input.text type="number" name="position" id="position" required />
                    @error('position')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label.input for="meta_keyword" :value="__('Meta Keyword')" />
                    <x-input.text type="text" name="meta_keyword" id="meta_keyword" />
                    @error('meta_keyword')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label.input for="images" :value="__('Gambar')" />
                    <span class="text-sm">Maksimal 2MB</span>
                    <x-input.text type="file" name="images" id="images" class="border border-gray-300" required
                        autofocus onchange="previewImage(this)" />
                    @error('images')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4" id="imagePreviewContainer" style="display: none;">
                    <x-label.input for="imagePreview" :value="__('Preview Gambar')" />
                    <img id="imagePreview" class="h-36 w-36 object-cover rounded-md" alt="Preview Gambar" />
                </div>
                <div class="mb-6">
                    <x-button.primary>
                        Tambah Kategori
                    </x-button.primary>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortableList = document.getElementById('sortableList');
            const updatePositionForm = document.getElementById('updatePositionForm');
            const saveChangesContainer = document.getElementById('saveChangesContainer');
            let initialPositions = Array.from(sortableList.children).map(li => li.getAttribute('data-id'));

            const sortable = new Sortable(sortableList, {
                animation: 150,
                handle: '.fa-grip-vertical',
                onUpdate: function(evt) {
                    const currentPositions = Array.from(evt.to.children).map(li => li.getAttribute(
                        'data-id'));
                    console.log('Current positions:',
                        currentPositions);
                    if (JSON.stringify(currentPositions) !== JSON.stringify(initialPositions)) {
                        saveChangesContainer.style.display = 'block';
                        console.log(
                            'Changes detected, showing save button');
                    } else {
                        saveChangesContainer.style.display = 'none';
                        console.log(
                            'No changes detected, hiding save button')
                    }
                }
            });
        });


        function previewImage(input) {
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    imagePreview.src = reader.result;
                    imagePreviewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @include('categories.partials.modal')
</x-dashboard-layout>
