<swiper-container class="mySwiper" space-between="30" free-mode="true" navigation="true">
    @php
        $count = 0;
    @endphp
    @foreach ($products as $product)
        @if ($count++ < 8)
            <swiper-slide>
                <x-card.product image="https://placehold.co/400" title="{{ $product->product_name }}"
                    price="Rp: {{ $product->price }}" link="/produk/{{ $product->id }}" />
            </swiper-slide>
        @endif
    @endforeach
</swiper-container>
