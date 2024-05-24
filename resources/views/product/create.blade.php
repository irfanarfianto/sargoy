<x-dashboard-layout>
    <div class="items-center mt-14">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Produk Baru') }}
            </h2>
            {{-- tombol kembali dan simpan --}}
            <div class="flex">
                <a href="{{ route('product.index') }}">
                    <x-button.secondary>
                        Kembali
                    </x-button.secondary>
                </a>
                <button form="product-form" type="submit"
                    class="ms-2 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-blue-400 dark:hover:bg-gray-700">
                    <x-button.primary>
                        Simpan
                    </x-button.primary>
                </button>
            </div>
        </div>
    </div>

    <div class="flex mt-3.5">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}">
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}">
            </div>
            <div>
                <label for="images">Images:</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*">
            </div>
            <div>
                <label for="categories">Categories:</label>
                <select id="categories" name="categories[]" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit">Create Product</button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
