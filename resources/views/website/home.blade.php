@extends('website.layout')
@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <style>
      
        .category-card {
            background: #fff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* 🔲 Square box */
        .category-img-box {
            width: 100%;
            aspect-ratio: 1 / 1;   /* makes it square */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        /* 🖼 Image inside square */
        .category-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        /* 📝 Text */
        .category-name {
            font-size: 13px;
            font-weight: 500;
            margin-top: 5px;
            white-space: nowrap;       /* single line */
            overflow: hidden;          /* hide extra text */
            text-overflow: ellipsis;   /* show ... */
        }
        .placeholder-icon {
            font-size: 30px;
            color: #ccc;
        }
    </style>
    
@endpush
@section('content')


<section class="section-main bg padding-y-sm">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
        
                <div id="homeSlider" class="carousel slide" data-ride="carousel">
        
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($slides as $key => $slide)
                            <li data-target="#homeSlider" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
        
                    <!-- Slides -->
                    <div class="carousel-inner rounded">
                        @foreach($slides as $key => $slide)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <a href="{{ $slide->link }}">
                                    <img src="{{ asset('/public/'.$slide->image) }}"
                                         class="d-block w-100 slider-img"
                                         alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
        
                    <!-- Controls -->
                    <a class="carousel-control-prev" href="#homeSlider" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#homeSlider" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
        
                </div>
        
            </div>
        </div>
        @php
            use App\Category;
            $menus = Menu::getByName('Category Menu');
        @endphp
        
        @if($menus)
        <div class="category-slider">
        
            @foreach($menus as $menu)
        
                @php
                    $cat = App\Category::where('categoryName','like',"%{$menu['label']}%")->first();
                @endphp
        
                <div class="p-2">
                    <a href="{{ $menu['link'] }}" class="category-card text-center d-block">

                        <div class="category-img-box">
                    
                            @if(!empty($cat->categoryImage))
                                <img src="{{ asset('public/product/thumbnail/'.$cat->categoryImage) }}"
                                     class="category-img">
                            @else
                                 <div class="placeholder-icon">
                                    <i class="fa fa-image"></i>
                                </div>
                            @endif
                    
                        </div>
                    
                        <div class="category-name">
                            {{ $menu['label'] }}
                        </div>
                    
                    </a>
                </div>
        
            @endforeach
        
        </div>
        @endif
    </div>
</section>

{{--
    
    
    <section class="section-name bg padding-y-sm pt-0">
        <div class="container">
            <header class="section-heading mt-0">
                <a href="{{ url('/category/'.$slug) }}" class="btn btn-info btn-sm float-right rounded">View More</a>
                <h4 class="section-title ">Dhamaka Offer</h4>
            </header><!-- sect-heading -->
            <div class="row no-gutters popular-product-slider">
                
                    @foreach($topProducts as $product)
                        <div>
                            <div href="#" class="card card-product-grid product-box-2">
                                <a href="{{ url('/product/'.$product->productSlug)  }}" class="img-wrap">
                                    <img class="img-fit" src="{{ asset('/public/product/thumbnail/'.$product->productImage)  }}" alt="{{ $product->productName  }}">
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
                                @if ($product->colors->isNotEmpty() || $product->sizes->isNotEmpty())
                                    <a href="{{ url('/product/'.$product->productSlug)  }}" class="btn btn-success btn-sm btn-block"> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন</a>
                                @else
                                <button class="btn btn-success btn-sm btn-block" onclick="buyNow({{ $product->id }})">
                                    <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন
                                </button>
                                @endif
                            </div>
                        </div> 
                    @endforeach
             
            </div> 
        </div><!-- container // -->
    </section>
    --}} 
    @foreach($sections as $section)
        <section class="section-name bg padding-y-sm pt-0">
            <div class="container">
                <header class="section-heading mt-0">
                    <!-- Check if category exists before accessing properties -->
                    @if($section->category)
                    
                        <a href="{{ url('/category/'.$section->category->categorySlug) }}" class="btn btn-info btn-sm float-right rounded">View More</a>
                        <h4 class="section-title">{{$section->category->categoryName}}</h4>
                    @else
                        <h4 class="section-title">No Category Available</h4>
                    @endif
                </header><!-- sect-heading -->
                <div class="row no-gutters popular-product-slider">
                    <!-- Check if category and products exist -->
                    @if($section->category && $section->category->products->isNotEmpty())
                        @foreach($section->category->products->sortBy('productCode')->take($section->max) as $product)
                            <div>
                                <div class="card card-product-grid product-box-2">
                                    <a href="{{ url('/product/'.$product->productSlug) }}" class="img-wrap">
                                        <!-- Check if product image exists -->
                                        <img class="img-fit" src="{{ asset('/public/product/thumbnail/'.($product->productImage ?? 'default-image.jpg')) }}" alt="{{ $product->productName ?? 'Product Name' }}">
                                        @if($product->isStockOut)
                                    <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Stock Out</span>
                                @else
                                @if($product->isFreeDelivery)
                                    <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Free Delivery</span>
                                @endif
                                @endif
                                    </a>
                                    <figcaption class="info-wrap">
                                        <!-- Check if product name exists -->
                                        <a href="{{ url('/product/'.$product->productSlug) }}" class="title text-truncate">{{ $product->productName ?? 'Product Name' }}</a>
                                        <div class="price mt-1 text-center">
                                            <!-- Check if htmlPrice() method exists -->
                                            {!! $product->htmlPrice() ?? 'Price Not Available' !!}
                                        </div>
                                    </figcaption>
                                    <!-- Check for colors or sizes availability before showing buttons -->
                                    @if ($product->colors->isNotEmpty() || $product->sizes->isNotEmpty() || $product->options->isNotEmpty())
                                        <a href="{{ url('/product/'.$product->productSlug) }}" class="btn btn-dark btn-sm btn-block <?php echo ($product->isStockOut)?'disabled':''; ?> "> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন</a>
                                    @else
                                        <!-- Check if product can be ordered -->
                                        <button <?php echo ($product->isStockOut)?'disabled':''; ?> class="btn btn-dark btn-sm btn-block" onclick="buyNow({{ $product->id }})">
                                            <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No products available for this category.</p>
                    @endif
                </div>
            </div><!-- container // -->
        </section>
    @endforeach
@if(Settings::get('home_page_all_products') == 'show')
    <section class="section-name bg padding-y-sm pt-0">
        <div class="container">
            <header class="section-heading mt-0">
                <a href="{{ url('/shop') }}" class="btn btn-info btn-sm float-right rounded">View More</a>
                <h4 class="section-title">Recommended For You</h4>
            </header>
            <div class="row no-gutters" id="loadProducts">
{{--                @foreach($otherProducts as $product)--}}
{{--                    <div class="col-md-2 col-6">--}}
{{--                        <div href="#" class="card card-product-grid product-box-2">--}}
{{--                            <a href="{{ url('/product/'.$product->id)  }}" class="img-wrap">--}}
{{--                                <img class="img-fit lazyload"   src="{{ asset('public/product/thumbnail/default.jpg') }}"  data-src="{{ asset('/public/product/thumbnail/'.$product->productImage)  }}" alt="{{ $product->productName  }}">--}}
{{--                            </a>--}}
{{--                            <figcaption class="info-wrap">--}}
{{--                                <a href="{{ url('/product/'.$product->id)  }}" class="title text-truncate">{{ $product->productName  }}</a>--}}
{{--                                <div class="price mt-1 text-center">--}}
{{--                                    {!! $product->htmlPrice() !!}--}}
{{--                                </div>--}}
{{--                            </figcaption>--}}
{{--                            <button class="btn btn-dark btn-sm btn-block" onclick="buyNow({{ $product->id }})">--}}
{{--                                <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
            <div class="loading" style=" display: flex; justify-content: center; align-items: center; ">
                <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M59.6 0h8v40h-8V0z" fill="#000000" fill-opacity="1"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(30 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(60 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(90 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(120 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#b2b2b2" fill-opacity="0.3" transform="rotate(150 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#999999" fill-opacity="0.4" transform="rotate(180 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#7f7f7f" fill-opacity="0.5" transform="rotate(210 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#666666" fill-opacity="0.6" transform="rotate(240 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#4c4c4c" fill-opacity="0.7" transform="rotate(270 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#333333" fill-opacity="0.8" transform="rotate(300 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#191919" fill-opacity="0.9" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="1080ms" repeatCount="indefinite"></animateTransform></g></svg>
            </div>
{{--            <div style=" display: flex; justify-content: center; margin-top: 39px; ">--}}
{{--                {{ $otherProducts->links() }}--}}
{{--            </div>--}}
        </div>
    </section>
@endif
@endsection

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
    <script>
        @if(Settings::get('home_page_all_products') == 'show')
        var page = 1;
        load_more(page);
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
                page++;
                load_more(page);
            }
        });
        function load_more(page){

           $.ajax({
                type: "get",
                datatype: "html",
                url: '<?php echo url('/getProducts')?>?page=' + page,
                success: function (data) {
                    // Check if the data is empty (no products available)
                    if ($.trim(data) === '') {
                        // Stop further requests and optionally display a message
                        $('.loading').hide();
                    } else {
                        // Append data into the #loadProducts element
                        $("#loadProducts").append(data);
                        lazyload(); // Call lazyload function
                    }
                },
                error: function() {
                    // Handle any error (optional)
                    $('.loading').hide();
                }
            });

        }
        @endif

        $(document).ready(function(){

            $('.popular-product-slider').slick({
                slidesToShow: 5,
                rows: 1,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa fa-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="fa fa-arrow-right"></i></button>',
                responsive: [
                                {
                                    breakpoint: 998, // For screens smaller than 998px
                                    settings: {
                                        rows: 1,
                                        slidesToShow: 4
                                    }
                                },
                                {
                                    breakpoint: 768, // For screens smaller than 768px (tablet size)
                                    settings: {
                                        rows: 1,
                                        slidesToShow: 3
                                    }
                                },
                                {
                                    breakpoint: 576, // For screens smaller than 576px (mobile size)
                                    settings: {
                                        rows: 1,
                                        slidesToShow: 2
                                    }
                                },
                                {
                                    breakpoint: 398, // For screens smaller than 484px (mobile size)
                                    settings: {
                                        rows: 1,
                                        slidesToShow: 2
                                    }
                                }
                            ]
            });
            
        });
    </script>
    <script>
$(document).ready(function(){

    $('.category-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,

        responsive: [
            {
                breakpoint: 1024,
                settings: { slidesToShow: 4 }
            },
            {
                breakpoint: 768,
                settings: { slidesToShow: 3 }
            },
            {
                breakpoint: 576,
                settings: { slidesToShow: 2 } // 📱 mobile = 2
            }
        ]
    });

});
</script>
    <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'view_homepage',
            'pageType': 'home',
            'ecommerce': {
                'currency': 'BDT',  // Change based on your currency
                'value': 0  // No transaction on homepage
            }
        });
    </script>
    <script>
      fbq('track', 'PageView', {
        content_category: 'HomePage',
        value: 0,
        currency: 'BDT'
      });
    </script>


@endpush
