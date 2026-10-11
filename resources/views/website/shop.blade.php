@extends('website.layout')
@section('content')
    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h4 class="section-title">All products</h4>
            </header>
            <div class="lk-products-grid">
                @foreach($shop as $product)
                    @include('website.partials.product_card', ['product' => $product])
                @endforeach
            </div>
            <div style=" display: flex; justify-content: center; margin-top: 39px; ">
                {{ $shop->links() }}
            </div>
        </div>
    </section>
    <script>
      fbq('track', 'ViewContent', {
        content_name: 'Shop Page',
        content_category: 'Shop',
        value: 0,
        currency: 'BDT'
      });
    </script>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        'event': 'view_shop',
        'pageType': 'shop',
        'ecommerce': {
            'currency': 'BDT',
            'value': 0
        }
    });
    </script>
@endsection
