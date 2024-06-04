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
        <form id="product-form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-wrap gap-2.5 w-full max-w-screen-xl">
            @csrf
            {{-- tampilan kiri --}}
            <div class="flex flex-col w-full lg:w-2/3">
                <div class="mb-4">
                    <x-label.input for="product_name" :value="__('Nama Produk')" />
                    <x-input.text type="text" id="product_name" name="product_name" value="{{ old('product_name') }}"
                        required autofocus />
                    <x-error.input-error :messages="$errors->get('product_name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-label.input for="description" :value="__('Deskripsi Produk')" />
                    <x-input.text type="text" id="description" name="description" value="{{ old('description') }}"
                        required />
                    <x-error.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            {{-- tampilan kanan --}}
            <div class="flex flex-col w-full lg:w-1/4">
                <div class="mb-4">
                    <x-label.input for="price" :value="__('Harga Produk')" />
                    <x-input.text type="text" id="price" name="price" value="{{ old('price') }}" required />
                    <x-error.input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
            </div>
        </form>
    </div>
</x-dashboard-layout>
