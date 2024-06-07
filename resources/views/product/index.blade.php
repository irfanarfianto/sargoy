<x-app-layout>
    <div class="flex mx-auto max-w-screen-xl p-4 gap-2">
        <aside class="w-1/4 hidden sm:block">
            <div class="bg-white p-4 border-r border-gray-200">
                <h3 class="text-xl mb-4">Filter</h3>
                <form action="">
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" id="category"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Semua</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <select name="price" id="price"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Semua</option>
                            <option value="1">Rp. 0 - Rp. 100.000</option>
                            <option value="2">Rp. 100.000 - Rp. 500.000</option>
                            <option value="3">Rp. 500.000 - Rp. 1.000.000</option>
                            <option value="4">Rp. 1.000.000 - Rp. 2.000.000</option>
                            <option value="5">Rp. 2.000.000 ke atas</option>
                        </select>
                    </div>
                </form>
            </div>
        </aside>
        <div class="w-full sm:w-5/6">
            <div id="productContainer">
                <div class="flex justify-between mb-4">
                    <select name="sort" id="sort"
                        class="block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Urutkan Berdasarkan</option>
                        <option value="1">Harga Terendah</option>
                        <option value="2">Harga Tertinggi</option>
                        <option value="3">Terbaru</option>
                    </select>
                    <select name="layout" id="layout"
                        class="block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="grid">Grid</option>
                        <option value="list">List</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6" id="gridView">
                    @foreach ($products as $product)
                        <x-card.product image="{{ asset($product->images->first()->image_path) }}"
                            title="{{ $product->product_name }}" price="{{ $product->price }}"
                            link="/produk/{{ $product->slug }}" />
                    @endforeach
                </div>
                <div class="flex flex-col gap-6" id="listView">
                    @foreach ($products as $product)
                        <x-card.product-list image="{{ asset($product->images->first()->image_path) }}"
                            title="{{ $product->product_name }}" price="{{ $product->price }}"
                            link="/produk/{{ $product->slug }}" />
                    @endforeach
                </div>
                <div class="flex justify-center mt-6">
                    <x-button.primary type="button" id="loadMoreBtn">Lihat Lebih Banyak</x-button.primary>
                </div>
            </div>
        </div>
    </div>

    <div id="drawer-navigation"
        class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
            Filter
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
            <form action="">
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" id="category"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Semua</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <select name="price" id="price"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Semua</option>
                        <option value="1">Rp. 0 - Rp. 100.000</option>
                        <option value="2">Rp. 100.000 - Rp. 500.000</option>
                        <option value="3">Rp. 500.000 - Rp. 1.000.000</option>
                        <option value="4">Rp. 1.000.000 - Rp. 2.000.000</option>
                        <option value="5">Rp. 2.000.000 ke atas</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div
        class="fixed z-50 justify-center inline-flex sm:hidden -translate-x-1/2 border border-gray-500 backdrop-blur-sm rounded-full bottom-4 left-1/2 dark:bg-gray-700 dark:border-gray-600">
        <x-button.text-icon icon="fa-solid fa-filter" class="border border-none focus:ring-0" type="button"
            data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
            aria-controls="drawer-navigation">
            filter
        </x-button.text-icon>
    </div>
</x-app-layout>


<script>
    var offset = 6;

    function loadMore() {
        $.ajax({
            url: '/load-more-products',
            method: 'GET',
            data: {
                offset: offset
            },
            success: function(data) {
                if (data.length > 0) {
                    data.forEach(function(product) {
                        var productCard = `
                            <x-card.product image="{{ asset($product->images->first()->image_path) }}" title="${product.product_name}"
                                price="${product.price}" link="/produk/${product.slug}" />
                        `;
                        $('#gridView').append(productCard);
                        var productList = `
                            <x-card.product-list image="{{ asset($product->images->first()->image_path) }}" title="${product.product_name}"
                                price="${product.price}" link="/produk/${product.slud}" />
                        `;
                        $('#listView').append(productList);
                    });
                    offset += 9;
                } else {
                    $('#loadMoreBtn').prop('disabled', true).text('Tidak ada produk lagi');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading more products:', error);
            }
        });
    }

    $('#loadMoreBtn').on('click', loadMore);

    $(document).ready(function() {
        var savedLayout = localStorage.getItem('layout');
        if (savedLayout) {
            $('#layout').val(savedLayout);
            applyLayout(savedLayout);
        }

        $('#layout').change(function() {
            var layout = $(this).val();
            localStorage.setItem('layout', layout);
            applyLayout(layout);
        });

        function applyLayout(layout) {
            if (layout === 'grid') {
                $('#gridView').removeClass('hidden');
                $('#listView').addClass('hidden');
            } else if (layout === 'list') {
                $('#gridView').addClass('hidden');
                $('#listView').removeClass('hidden');
            }
        }
    });
</script>
