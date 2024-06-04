<x-app-layout>
    <div class="pb-6">
        <x-carousel />
    </div>

    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <h1 class="flex text-3xl font-bold text-gray-800 justify-start mb-6">Produk terbaru</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
                $count = 0;
            @endphp
            @foreach ($products as $product)
                @if ($count++ < 4)
                    <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                        price="Rp: {{ $product->price }}" link="/produk/{{ $product->id }}" />
                @endif
            @endforeach
        </div>
        <div class="flex justify-center mt-4">
            <a href="{{ route('product.index') }}">
                <x-button.primary>
                    Lihat Semua
                </x-button.primary>
            </a>
        </div>
    </section>

    {{-- pengenalan produk --}}
    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <div class="flex flex-col sm:flex-row gap-8">
                <div class="w-full gap-2 sm:w-1/2">
                    <div class="flex w-full items-center mt-2 gap-2">
                        <div class="relative">
                            <img src="https://placehold.co/800x400" alt="gambar produk"
                                class="object-cover rounded-lg h-48 w-full">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 opacity-0"></div>
                        </div>
                        <div class="relative">
                            <img src="https://placehold.co/400x400" alt="gambar produk"
                                class="object-cover rounded-lg h-48 w-full">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 opacity-0"></div>
                        </div>
                    </div>
                    <div class="flex w-full items-center mt-2 gap-2">
                        <div class="relative">
                            <img src="https://placehold.co/400x400" alt="gambar produk"
                                class="object-cover rounded-lg h-48 w-full">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 opacity-0"></div>
                        </div>
                        <div class="relative">
                            <img src="https://placehold.co/800x400" alt="gambar produk"
                                class="object-cover rounded-lg h-48 w-full">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 opacity-0"></div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full sm:w-1/2">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Sarung Goyor Mendunia!</h1>
                    <p class="text-gray-500">
                        Sarung Goyor adalah produk sarung yang dibuat dengan bahan baku yang berkualitas tinggi dan
                        diproduksi secara manual. Berikut adalah keunggulan Sarung Goyor:
                    </p>
                    <ul class="list-disc ml-4 mt-4">
                        <li class="text-blue-500">Kualitas bahan baku yang terjamin</li>
                        <li class="text-blue-500">Karakteristik unik yang menarik</li>
                        <li class="text-blue-500">Dibuat secara manual</li>
                    </ul>
                    <div class="mt-4 ">
                        <x-button.primary href="{{ route('product.index') }}">
                            Lihat Semua <i class="ms-1 fa-solid fa-arrow-right"></i>
                        </x-button.primary>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <h1 class="flex text-3xl font-bold text-gray-800 justify-start mb-6">Produk Unggulan</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
                $count = 0;
            @endphp
            @foreach ($products as $product)
                @if ($count++ < 4)
                    <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                        price="Rp: {{ $product->price }}" link="/produk/{{ $product->id }}" />
                @endif
            @endforeach
        </div>
        <div class="flex justify-center mt-4">
            <a href="{{ route('product.index') }}">
                <x-button.primary>
                    Lihat Semua
                </x-button.primary>
            </a>
        </div>
    </section>


    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <div class="bg-gray-50 py-12">
            <div class="max-w-screen-lg mx-auto flex flex-col items-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Ajakan Seller Anda Menjadi Bagian Kami!</h1>
                <p class="text-gray-500 mb-4">
                    Sarung Goyor akan memberikan pengalaman kerja yang menyenangkan dan berperan dalam meningkatkan
                    kualitas sarung di Indonesia.
                </p>
                <div class="mt-4">
                    <a href="#">
                        <x-button.primary>
                            Join Sekarang
                        </x-button.primary>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <h1 class="flex text-3xl font-bold text-gray-800 justify-start mb-6">Semua Produk</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
                $count = 0;
            @endphp
            @foreach ($products as $product)
                @if ($count++ < 8)
                    <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                        price="Rp: {{ $product->price }}" link="/produk/{{ $product->id }}" />
                @endif
            @endforeach
        </div>
        <div class="flex justify-center mt-4">
            <a href="{{ route('product.index') }}">
                <x-button.primary>
                    Lihat Semua
                </x-button.primary>
            </a>
        </div>
    </section>

</x-app-layout>
