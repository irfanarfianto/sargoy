<x-dashboard-layout>
    <div class="items-center mt-14">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Produk') }}
            </h2>
            <a href="{{ route('product.create') }}">
                <x-button.primary>
                    Tambah Produk
                </x-button.primary>
            </a>
        </div>
        <div class="flex items-center gap-x-1">
            <form action="{{ route('dashboard.product.index') }}" method="GET">
                <div class="relative">
                    <x-input.text id="search" name="search" type="text" placeholder="Cari..." />

                    <x-error.input-error :messages="$errors->get('search')" class="mt-2" />

                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
            <div class="relative">
                <x-button.secondary id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="flex items-center mb-0" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>Filter
                </x-button.secondary>
                <!-- Dropdown Menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-gray-100 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('dashboard.product.index', ['sort' => 'latest']) }}"
                                class="block px-4 py-2 hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request('sort') == 'latest' ? 'bg-gray-100 dark:bg-gray-600 text-blue-500' : '' }}">Terbaru</a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.product.index', ['sort' => 'price_asc']) }}"
                                class="block px-4 py-2 hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request('sort') == 'price_asc' ? 'bg-gray-100 dark:bg-gray-600 text-blue-500' : '' }}">Harga
                                Terendah</a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.product.index', ['sort' => 'price_desc']) }}"
                                class="block px-4 py-2 hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request('sort') == 'price_desc' ? 'bg-gray-100 dark:bg-gray-600 text-blue-500' : '' }}">Harga
                                Tertinggi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-6">
        <x-table>
            <x-slot name="thead">
                <th class="p-3 text-left text-xs font-medium text-gray-500">
                    <input type="checkbox" id="select-all"
                        class="form-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </th>
                {{-- <th class="p-3 text-left text-xs font-medium text-gray-500">No</th> --}}
                <th class="p-3 text-left text-xs w-1/2 font-medium text-gray-500">Nama Produk / Kode / Kategori
                </th>
                <th class="p-3 text-left text-xs font-medium text-gray-500">Gambar / Harga</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500">Status</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500">Aksi</th>
            </x-slot>
            @foreach ($products as $product)
                <tr
                    class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">

                    <td class="p-3">
                        <input type="checkbox"
                            class="form-checkbox select-item w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            data-id="{{ $product->id }}">
                    </td>
                    {{-- <td class="p-3 whitespace-nowrap text-sm text-gray-900">
                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}
                    </td> --}}
                    <td class="p-3 whitespace-nowrap">
                        <div class="font-bold text-md text-gray-900">{{ $product->product_name }}</div>
                        <div class="text-sm text-gray-500">KFN-414</div>
                        <div class="text-sm text-gray-500">Pakaian</div>
                    </td>
                    <td class="p-3 whitespace-nowrap">
                        <div class="flex items-start space-x-2">
                            <img class="w-14 h-14 rounded-sm" src="https://placehold.co/400"
                                alt="{{ $product->product_name }}">
                            <div class="text-sm text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                    </td>
                    <td class="p-3 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    </td>
                    <td class="p-3 whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            <button href="{{ route('product.show', $product->id) }}"
                                data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                                aria-controls="drawer-navigation"
                                class="p-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <a href="{{ route('product.edit', $product->id) }}"
                                class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                class="p-2 bg-red-500 text-white rounded hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                id="delete-form-{{ $product->id }}" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-table>
        <div class="flex justify-end">
            {{ $products->appends(request()->input())->links('vendor.pagination.product') }}
        </div>
    </div>
    <x-modal-popup id="popup-modal" message="Are you sure you want to delete this product?"
        confirmButtonText="Yes, I'm sure" cancelButtonText="No, cancel">
        <form id="delete-confirm-form" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </x-modal-popup><!-- drawer component -->
    <div id="drawer-navigation"
        class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
            Menu
        </h5>
        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">

        </div>
    </div>
</x-dashboard-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.select-item');

        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false;
                } else if (Array.from(itemCheckboxes).every(item => item.checked)) {
                    selectAllCheckbox.checked = true;
                }
            });
        });
    });
</script>
