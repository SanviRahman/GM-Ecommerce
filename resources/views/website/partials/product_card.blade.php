{{-- Shared collection-inspired product card: homepage, shop, category, related and AJAX. --}}
@php
    $productUrl = url('/product/'.$product->productSlug);
    $hasVariants = $product->colors->isNotEmpty()
        || $product->sizes->isNotEmpty()
        || $product->options->isNotEmpty();
    $soldOut = $product->isSoldOut();
    $freeDelivery = (int) $product->isFreeDelivery === 1;
@endphp
<article class="lk-product-card">
    <a class="lk-product-card-image" href="{{ $productUrl }}" aria-label="{{ $product->productName }}">
        <img src="{{ \App\Support\PublicMedia::url('product/thumbnail/'.$product->productImage) }}"
             alt="{{ $product->productName }}" loading="lazy">
        @include('website.partials.product_badge', ['product' => $product])
    </a>
    <div class="lk-product-card-details">
        <a href="{{ $productUrl }}" class="lk-product-card-name" title="{{ $product->productName }}">
            {{ $product->productName }}
        </a>
        <div class="lk-product-card-price">{!! $product->htmlPrice() !!}</div>
    </div>
    @if($soldOut)
        <button class="lk-product-card-action" type="button" disabled>Sold out</button>
    @elseif($hasVariants)
        <a class="lk-product-card-action" href="{{ $productUrl }}">
            {{ $freeDelivery ? 'ফ্রী ডেলিভারিতে অর্ডার করুন' : 'অর্ডার করুন' }}
        </a>
    @else
        <button class="lk-product-card-action" type="button" onclick="buyNow({{ $product->id }})">
            {{ $freeDelivery ? 'ফ্রী ডেলিভারিতে অর্ডার করুন' : 'অর্ডার করুন' }}
        </button>
    @endif
</article>
