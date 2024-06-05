<x-app-layout>
    <div class="flex mx-auto max-w-screen-xl p-4 gap-2">
        <div class="w-1/4">
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
        </div>
        <div class="w-5/6">
            <div class="bg-white p-4" id="productContainer">
                <div class="flex justify-between mb-4">
                    <select name="sort" id="sort"
                        class="block px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Urutkan Berdasarkan</option>
                        <option value="1">Harga Terendah</option>
                        <option value="2">Harga Tertinggi</option>
                        <option value="3">Terbaru</option>
                    </select>
                    <select name="layout" id="layout"
                        class="block px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="grid">Grid</option>
                        <option value="list">List</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6" id="gridView">
                    @foreach ($products as $product)
                        <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                            price="Rp: {{ $product->price }}" link="/produk/{{ $product->slug }}" />
                    @endforeach
                </div>
                <div class="flex flex-col gap-6" id="listView">
                    @foreach ($products as $product)
                        <x-card.product-list image="https://placehold.co/400" title="{{ $product->product_name }}"
                            price="Rp: {{ $product->price }}" link="/produk/{{ $product->slug }}" />
                    @endforeach
                </div>
                <div class="flex justify-center mt-6">
                    <x-button.primary type="button" id="loadMoreBtn">Lihat Lebih Banyak</x-button.primary>
                </div>
            </div>
        </div>
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
                            <x-card.product image="https://placehold.co/400" title="${product.product_name}"
                                price="Rp: ${product.price}" link="/produk/${product.id}" />
                        `;
                        $('#gridView').append(productCard);
                        var productList = `
                            <x-card.product-list image="https://placehold.co/400" title="${product.product_name}"
                                price="Rp: ${product.price}" link="/produk/${product.id}" />
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
