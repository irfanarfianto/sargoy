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
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
