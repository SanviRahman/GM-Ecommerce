@extends('website.layout')
@section('content')
    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h4 class="section-title">{{ $category->categoryName }}</h4>
            </header>
            <div class="lk-products-grid">
                @foreach($categoryProducts as $product)
                    @include('website.partials.product_card', ['product' => $product])
                @endforeach
            </div>
            <div style=" display: flex; justify-content: center; margin-top: 39px; ">
                {{ $categoryProducts->links() }}
            </div>
        </div>
    </section>
    <script>
      fbq('track', 'ViewContent', {
        content_name: '{{ $category->categoryName }}',
        content_category: 'Category',
        value: 0,
        currency: 'BDT'
      });
    </script>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        'event': 'view_category',
        'pageType': 'category',
        'categoryName': '{{ $category->categoryName }}',
        'ecommerce': {
            'currency': 'BDT',
            'value': 0
        }
    });
    </script>
@endsection
