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
                                <img class="img-fit lazyload"   src="{{ url('public/product/thumbnail/default.jpg') }}"  data-src="{{ url('/public/product/thumbnail/'.$product->productImage)  }}" alt="{{ $product->productName  }}">
                                @if($product->isStockOut)
                                    <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Stock Out</span>
                                @else
                                @if($product->isFreeDelivery)
                                    <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Free Delivery</span>
                                @endif
                                @endif
                            </a>
                            <figcaption class="info-wrap">
                                <a href="{{ url('/product/'.$product->productSlug)  }}" class="title text-truncate">{{ $product->productName  }}</a>
                                <div class="price mt-1 text-center">
                                    {!! $product->htmlPrice() !!}
                                </div>
                            </figcaption>
                            @if ($product->colors->isNotEmpty() || $product->sizes->isNotEmpty() || $product->options->isNotEmpty())
                                <a  href="{{ url('/product/'.$product->productSlug)  }}" class="btn btn-dark btn-sm btn-block <?php echo ($product->isStockOut)?'disabled':''; ?> "> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন</a>
                            @else
                            <button <?php echo ($product->isStockOut)?'disabled':''; ?>  class="btn btn-dark btn-sm btn-block" onclick="addToCart({{ $product->id }})">
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
