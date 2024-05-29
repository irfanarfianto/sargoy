<x-dashboard-layout>
    <div class="items-center mt-14">
        <div class="flex items-center justify-between flex-wrap w-full max-w-screen-xl">
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

                <x-button.primary form="product-form" type="submit">
                    Simpan
                </x-button.primary>
            </div>
        </div>
    </div>

    <div class="flex mt-3.5">
        <form id="product-form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-wrap gap-2.5 w-full max-w-screen-xl">
            @csrf
            {{-- tampilan kiri --}}
            <div class="flex flex-col w-full lg:w-4/6 p-4 border border-gray-300 rounded-md">
                <div class="mb-4">
                    <x-label.input for="product_name" :value="__('Nama Produk')" />
                    <x-input.text type="text" id="product_name" name="product_name" value="{{ old('product_name') }}"
                        required autofocus />
                    <x-error.input-error :messages="$errors->get('product_name')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-label.input for="description" :value="__('Deskripsi Produk')" />
                    <x-input.textarea type="text" id="description" name="description"
                        value="{{ old('description') }}" required />
                    <x-error.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            {{-- tampilan kanan --}}
            <div class="flex flex-col w-full lg:w-1/4 p-4 border border-gray-300 rounded-md">
                <div class="mb-4">
                    <x-label.input for="price" :value="__('Harga Produk')" />
                    <x-input.text type="text" id="price" name="price" value="{{ old('price') }}" required
                        oninput="formatRupiah(this)" />
                    <x-error.input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div class="relative inline-block text-left">
                    <button id="categoryDropdownButton" data-dropdown-toggle="categoryDropdown"
                        data-dropdown-trigger="hover"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Select Category <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="categoryDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="categoryDropdownButton">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <x-label.input for="category" :value="__('Kategori')" />
                    <select id="category" name="category_id"
                        class="block w-full mt-1 text-gray-700 rounded-md border border-gray-300">
                        <option value="" class="text-gray-700">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" class="text-gray-700 py-2">{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <x-label.input for="status" :value="__('Status Produk')" />
                    <label class="inline-flex items-center mt-2 cursor-pointer">
                        <input type="checkbox" id="status" name="status" class="sr-only peer"
                            onchange="toggleStatusText()">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span id="status-text" class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                            Aktif</span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <script>
        function formatRupiah(element) {
            let value = element.value;
            value = value.replace(/[^,\d]/g, "").toString();
            let split = value.split(",");
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
            element.value = rupiah ? "Rp. " + rupiah : "";
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const statusCheckbox = document.getElementById('status');
            const statusText = document.getElementById('status-text');

            const status = localStorage.getItem('status');
            if (status !== null) {
                statusCheckbox.checked = status === 'true';
                statusText.textContent = status === 'true' ? 'Aktif' : 'Tidak Aktif';
            }

            statusCheckbox.addEventListener('change', function() {
                localStorage.setItem('status', this.checked);
                statusText.textContent = this.checked ? 'Aktif' : 'Tidak Aktif';
            });
        });
    </script>
</x-dashboard-layout>
