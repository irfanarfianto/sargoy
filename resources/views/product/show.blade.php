<x-app-layout>
    <div class="flex flex-col mx-auto max-w-screen-xl p-4">
        <div class="flex justify-center">
            <x-breadcrumb.breadcrumb :items="$breadcrumbItems" />
        </div>
        <div class="flex flex-row md:flex-wrap items-start justify-center mt-4">
            <div class="flex flex-col max-w-1/3">
                @foreach ($product->images->take(1) as $image)
                    <img src="{{ asset($image->image_path) }}" alt="{{ $product->product_name }}"
                        class="object-cover rounded-lg h-60">
                @endforeach
                <div class="flex flex-row gap-1 w-full mt-2">
                    @foreach ($product->images->take(4) as $image)
                        <img src="{{ asset($image->image_path) }}" alt="{{ $product->product_name }}"
                            class="object-cover rounded-lg h-20 w-20">
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col mt-4 md:mt-0 md:ml-4 w-full md:w-2/3">
                <p>
                    <strong>Categories: </strong>
                    @foreach ($product->categories as $category)
                        <span class="badge badge-primary">{{ $category->category_name }}</span>
                    @endforeach
                </p>
                <h1 class="text-2xl font-semibold">{{ $product->product_name }}</h1>
                <p class="text-gray-500 mt-2">{{ $product->description }}</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <x-button.text-icon icon="fa-solid fa-cart-shopping"
                        class="bg-green-500 text-white items-center justify-center text-xl">
                        Beli
                    </x-button.text-icon>
                    <x-button.text-icon icon="fa-brands fa-whatsapp"
                        class="bg-green-500 text-white items-center justify-center text-xl">
                        Pesan
                    </x-button.text-icon>
                    <x-button.text-icon icon="fa-brands fa-tokopedia"
                        class="bg-green-500 text-white items-center justify-center text-xl">
                        Tokopedia
                    </x-button.text-icon>
                    <x-button.text-icon icon="fa-brands fa-whatsapp"
                        class="bg-orange-500 text-white items-center justify-center text-xl">
                        Shoppe
                    </x-button.text-icon>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
