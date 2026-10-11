@extends('website.layout')
@section('content')

    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h4 class="section-title">{{ $category->categoryName }}</h4>
            </header>
            <div class="row no-gutters">
                @foreach($categoryProducts as $product)
                    <div class="col-md-2 col-6">
                        <div href="#" class="card card-product-grid product-box-2">
                            <a href="{{ url('/product/'.$product->productSlug)  }}" class="img-wrap">
                                <img class="img-fit lazyload"   src="{{ \App\Support\PublicMedia::url('product/thumbnail/'.$product->productImage)  }}" data-src="{{ \App\Support\PublicMedia::url('product/thumbnail/'.$product->productImage)  }}" alt="{{ $product->productName  }}">
                                        @include('website.partials.product_badge', ['product' => $product])
                            </a>
                            <figcaption class="info-wrap">
                                <a href="{{ url('/product/'.$product->productSlug)  }}" class="title text-truncate">{{ $product->productName  }}</a>
                                <div class="price mt-1 text-center">
                                    {!! $product->htmlPrice() !!}
                                </div>
                            </figcaption>
                            @if ($product->colors->isNotEmpty() || $product->sizes->isNotEmpty() || $product->options->isNotEmpty())
                                <a  href="{{ url('/product/'.$product->productSlug)  }}" class="btn btn-dark btn-sm btn-block <?php echo ($product->isSoldOut())?'disabled':''; ?> "> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন</a>
                            @else
                            <button <?php echo ($product->isSoldOut())?'disabled':''; ?>  class="btn btn-dark btn-sm btn-block" onclick="addToCart({{ $product->id }})">
                                <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন
                            </button>
                            @endif
                        </div>
                    </div> <!-- col.// -->
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
