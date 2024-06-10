<x-dashboard-layout>
    <div class="mt-14 flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('dashboard.product.index') }}">
                <x-button.secondary>
                    Kembali
                </x-button.secondary>
            </a>
            <x-button.primary form="product-form">
                Simpan
            </x-button.primary>
        </div>
    </div>

    <div class="flex mt-4">
        <form id="product-form" action="{{ route('product.update', $product->slug) }}" method="POST"
            enctype="multipart/form-data" class="flex flex-wrap gap-4 w-full max-w-screen-xl">
            @csrf
            @method('PUT')
            {{-- tampilan kiri --}}
            <div class="flex flex-col w-full lg:w-2/3">
                <div class="mb-4 p-4 bg-white border border-gray-300 rounded-md">
                    <div class="mb-4">
                        <x-label.input for="product_name" :value="__('Nama Produk*')" class="mb-2" />
                        <x-input.text type="text" id="product_name" name="product_name"
                            value="{{ old('product_name', $product->product_name) }}" required autofocus />
                        <x-error.input-error :messages="$errors->get('product_name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-label.input for="slug" :value="__('Slug Produk*')" class="mb-2" />
                        <x-input.text type="text" id="slug" name="slug"
                            value="{{ old('slug', $product->slug) }}" required readonly />
                        <x-error.input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-label.input for="categories" :value="__('Kategori Produk*')" class="mb-2" />
                        <select id="categories" name="categories[]" required
                            class="border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-error.input-error :messages="$errors->get('categories')" class="mt-2" />
                    </div>
                </div>
                <div class="mb-4 p-4 bg-white border border-gray-300 rounded-md">
                    <x-label.input for="description" :value="__('Deskripsi Produk*')" class="mb-2" />
                    <textarea id="description" name="description" rows="4" class="block w-full mt-1 rounded-md" required>{{ old('description', $product->description) }}</textarea>
                    <x-error.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="flex flex-col p-4 bg-white border border-gray-300 rounded-md">
                    <x-label.input for="images" :value="__('Gambar Produk')" class="mb-2" />
                    <p class="text-sm text-gray-500">Resolusi gambar harus sekitar 1:1, dan maksimal ukuran 2MB</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="image-grid">
                        @if ($product->images)
                            @foreach ($product->images as $image)
                                <div class="relative mb-4 group">
                                    <img src="{{ asset($image->image_path) }}"
                                        class="block w-full h-36 object-contain rounded-md">
                                    <div class="absolute top-0 right-0 hidden group-hover:flex flex-col space-y-1 p-1">
                                        <button class="bg-gray-800 text-white text-xs p-1 rounded"
                                            onclick="replaceImage(this)">Ganti</button>
                                        <button class="bg-red-600 text-white text-xs p-1 rounded"
                                            onclick="deleteImage(this)">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="relative mb-4">
                            <input type="file" id="images1" name="images[]"
                                class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" multiple />
                            <div
                                class="block h-36 w-full border-2 border-dashed border-gray-300 rounded-md flex flex-col justify-center items-center">
                                <i class="fa-solid fa-camera"></i>
                                <p class="text-sm text-gray-500">jpg, png, svg</p>
                            </div>
                            <x-error.input-error :messages="$errors->get('images.0')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- tampilan kanan --}}
            <div class="flex flex-col w-full lg:w-1/4">
                <div class="mb-4">
                    <x-label.input for="price" :value="__('Harga Produk*')" />
                    <x-input.text type="number" id="price" name="price"
                        value="{{ old('price', number_format(floatval($product->price), 0, '', '')) }}"
                        inputmode="numeric" pattern="\d*" required />
                    <x-error.input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
            </div>
        </form>
    </div>
</x-dashboard-layout>

<script>
    document.getElementById('images1').addEventListener('change', function(event) {
        const imageGrid = document.getElementById('image-grid');
        const files = event.target.files;
        const maxImages = 3;
        const currentImageCount = imageGrid.childElementCount - 1;
        const filesToAdd = Math.min(files.length, maxImages - currentImageCount);
        if (currentImageCount + filesToAdd > maxImages) {
            alert('Anda hanya bisa mengunggah maksimal 4 gambar.');
            this.value = '';
            return;
        }
        for (let i = 0; i < filesToAdd; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative mb-4 group';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'block w-full h-36 object-contain rounded-md';
                const buttonsDiv = document.createElement('div');
                buttonsDiv.className =
                    'absolute top-0 right-0 hidden group-hover:flex flex-col space-y-1 p-1';
                const replaceButton = document.createElement('button');
                replaceButton.className = 'bg-gray-800 text-white text-xs p-1 rounded';
                replaceButton.innerText = 'Ganti';
                replaceButton.onclick = function(event) {
                    event.preventDefault(); // Mencegah aksi default tombol
                    const replaceInput = document.createElement('input');
                    replaceInput.type = 'file';
                    replaceInput.accept = 'image/*';
                    replaceInput.onchange = function() {
                        const newFile = replaceInput.files[0];
                        const newReader = new FileReader();
                        newReader.onload = function(e) {
                            img.src = e.target.result;
                        };
                        newReader.readAsDataURL(newFile);
                    };
                    replaceInput.click();
                };
                const deleteButton = document.createElement('button');
                deleteButton.className = 'bg-red-600 text-white text-xs p-1 rounded';
                deleteButton.innerText = 'Hapus';
                deleteButton.onclick = function(event) {
                    event.preventDefault(); // Mencegah aksi default tombol
                    div.remove();
                };
                buttonsDiv.appendChild(replaceButton);
                buttonsDiv.appendChild(deleteButton);
                div.appendChild(img);
                div.appendChild(buttonsDiv);
                imageGrid.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('product_name').addEventListener('input', function() {
        const slug = this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)+/g, '');
        document.getElementById('slug').value = slug;
    });

    function replaceImage(button) {
        event.preventDefault(); // Mencegah aksi default tombol
        const replaceInput = document.createElement('input');
        replaceInput.type = 'file';
        replaceInput.accept = 'image/*';
        replaceInput.onchange = function() {
            const newFile = replaceInput.files[0];
            const newReader = new FileReader();
            newReader.onload = function(e) {
                button.parentElement.previousElementSibling.src = e.target.result;
            };
            newReader.readAsDataURL(newFile);
        };
        replaceInput.click();
    }

    function deleteImage(button) {
        event.preventDefault(); // Mencegah aksi default tombol
        button.parentElement.parentElement.remove();
    }
</script>
