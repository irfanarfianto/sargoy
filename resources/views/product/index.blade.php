<x-app-layout>
    <div class="flex mx-auto max-w-screen-xl p-4">
        <h2 class="font-semibold mt-14 text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
            @foreach($products as $product)
            <x-card.product image="{{ $product->images }}"
                title="{{ $product->name }}"
                price="Rp: {{ $product->price }}"
                link="/produk/{{ $product->id }}" />
            @endforeach
        </h2>
    </div>
</x-app-layout>
