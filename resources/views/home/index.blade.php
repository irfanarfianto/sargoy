<x-app-layout>
    <div class="pb-6">
        <x-carousel />
    </div>

    <section class="py-6 max-w-screen-xl mx-auto px-4 sm:px-6">
        <swiper-container id="mySwiper0" class="mySwiper" space-between="5" free-mode="true">
            @foreach ($categories as $category)
                <swiper-slide>
                    <div class="flex flex-col items-center justify-center">
                        <img src="{{ $category->images }}" alt="{{ $category->name }}"
                            class="w-24 h-24 object-cover rounded-full mb-4">
                        <h2 class="text-center text-lg font-bold text-gray-800">{{ $category->category_name }}</h2>
                    </div>
                </swiper-slide>
            @endforeach
        </swiper-container>
    </section>

    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between mb-6">
            <h1 class="flex text-3xl font-bold text-gray-800 justify-start">Produk terbaru</h1>
            <div class="flex items-center gap-2">
                <swiper-button-prev class="swiper-button-prev-1">
                    <x-button.icon icon="fas fa-chevron-left">
                    </x-button.icon>
                </swiper-button-prev>
                <swiper-button-next class="swiper-button-next-1">
                    <x-button.icon icon="fa-solid fa-chevron-right">
                    </x-button.icon>
                </swiper-button-next>
            </div>
        </div>
        <swiper-container id="mySwiper1" class="mySwiper" space-between="30" free-mode="true" navigation="true">
            @foreach ($products->take(8) as $product)
                <swiper-slide>
                    @if ($product->images->isNotEmpty())
                        <x-card.product image="{{ asset($product->images->first()->image_path) }}"
                            title="{{ $product->product_name }}" price="{{ $product->price }}"
                            link="/produk/{{ $product->slug }}" />
                    @else
                        <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                            price="{{ $product->price }}" link="/produk/{{ $product->slug }}" />
                    @endif
                </swiper-slide>
            @endforeach
        </swiper-container>
        <div class="flex justify-center mt-4">
            <a href="{{ route('public.product.index') }}">
                <x-button.secondary>
                    Lihat Semua
                </x-button.secondary>
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
                    <div class="mt-4">
                        <x-button.secondary href="{{ route('public.product.index') }}">
                            Lihat Semua <i class="ms-1 fa-solid fa-arrow-right"></i>
                        </x-button.secondary>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between mb-6">
            <h1 class="flex text-3xl font-bold text-gray-800 justify-start">Produk Unggulan</h1>
            <div class="flex items-center gap-2">
                <swiper-button-prev class="swiper-button-prev-2">
                    <x-button.icon icon="fas fa-chevron-left">
                    </x-button.icon>
                </swiper-button-prev>
                <swiper-button-next class="swiper-button-next-2">
                    <x-button.icon icon="fa-solid fa-chevron-right">
                    </x-button.icon>
                </swiper-button-next>
            </div>
        </div>
        <swiper-container id="mySwiper2" class="mySwiper" space-between="30" free-mode="true" navigation="true">
            @foreach ($products->take(8) as $product)
                <swiper-slide>
                    @if ($product->images->isNotEmpty())
                        <x-card.product image="{{ asset($product->images->first()->image_path) }}"
                            title="{{ $product->product_name }}" price="{{ $product->price }}"
                            link="/produk/{{ $product->slug }}" />
                    @else
                        <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                            price="{{ $product->price }}" link="/produk/{{ $product->slug }}" />
                    @endif
                </swiper-slide>
            @endforeach
        </swiper-container>
        <div class="flex justify-center mt-4">
            <a href="{{ route('public.product.index') }}">
                <x-button.secondary>
                    Lihat Semua
                </x-button.secondary>
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
                        <x-button.secondary>
                            Join Sekarang
                        </x-button.secondary>
                    </a>
                </div>
            </div>
        </div>
    </section>



    <section class="py-4 max-w-screen-xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between mb-6">
            <h1 class="flex text-3xl font-bold text-gray-800 justify-start">Semua Produk</h1>
            <div class="flex items-center gap-2">
                <swiper-button-prev class="swiper-button-prev-3">
                    <x-button.icon icon="fas fa-chevron-left">
                    </x-button.icon>
                </swiper-button-prev>
                <swiper-button-next class="swiper-button-next-3">
                    <x-button.icon icon="fa-solid fa-chevron-right">
                    </x-button.icon>
                </swiper-button-next>
            </div>
        </div>
        <swiper-container id="mySwiper3" class="mySwiper" space-between="30" free-mode="true" navigation="true">
            @foreach ($products->take(8) as $product)
                <swiper-slide>
                    @if ($product->images->isNotEmpty())
                        <x-card.product image="{{ asset($product->images->first()->image_path) }}"
                            title="{{ $product->product_name }}" price="{{ $product->price }}"
                            link="/produk/{{ $product->slug }}" />
                    @else
                        <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                            price="{{ $product->price }}" link="/produk/{{ $product->slug }}" />
                    @endif
                </swiper-slide>
            @endforeach
        </swiper-container>
        <div class="flex justify-center mt-4">
            <a href="{{ route('public.product.index') }}">
                <x-button.secondary>
                    Lihat Semua
                </x-button.secondary>
            </a>
        </div>
    </section>

</x-app-layout>

<script>
    const swiperEl0 = document.getElementById('mySwiper0');
    const swiperEl1 = document.getElementById('mySwiper1');
    const swiperEl2 = document.getElementById('mySwiper2');
    const swiperEl3 = document.getElementById('mySwiper3');

    Object.assign(swiperEl0, {
        breakpoints: {
            640: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 50,
            },
        },
    });

    Object.assign(swiperEl1, {
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
        navigation: {
            nextEl: '.swiper-button-next-1',
            prevEl: '.swiper-button-prev-1',
        },
    });

    Object.assign(swiperEl2, {
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
        navigation: {
            nextEl: '.swiper-button-next-2',
            prevEl: '.swiper-button-prev-2',
        },
    });

    Object.assign(swiperEl3, {
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
        navigation: {
            nextEl: '.swiper-button-next-3',
            prevEl: '.swiper-button-prev-3',
        },
    });

    swiperEl0.initialize();
    swiperEl1.initialize();
    swiperEl2.initialize();
    swiperEl3.initialize();
</script>
