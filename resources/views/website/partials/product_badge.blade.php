@if($product->isSoldOut())
    <span class="leatherket-product-badge leatherket-badge-sold">Sold out</span>
@elseif($product->salePercentage() > 0)
    <span class="leatherket-product-badge leatherket-badge-sale">{{ $product->salePercentage() }}% Sale</span>
@elseif($product->isFreeDelivery)
    <span class="leatherket-product-badge leatherket-badge-delivery">Free Delivery</span>
@endif
