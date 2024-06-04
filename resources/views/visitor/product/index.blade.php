<x-app-layout>
    <div class="flex mx-auto max-w-screen-xl p-4">
        <div class="w-1/6">
            <div class="bg-white p-4 border-r border-gray-200">
                <h3 class="text-xl mb-4">Filter</h3>
                <form action="">
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" id="category" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Semua</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <select name="price" id="price" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
            <div class="bg-white p-4">
                <h3 class="text-xl mb-4">Produk</h3>
                
            </div>
        </div>
    </div>
</x-app-layout>
</x-app-layout>
