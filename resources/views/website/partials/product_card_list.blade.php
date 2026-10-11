@foreach($otherProducts as $product)
    @include('website.partials.product_card', ['product' => $product])
@endforeach
