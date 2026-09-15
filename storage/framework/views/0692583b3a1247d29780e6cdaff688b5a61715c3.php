
<?php $__env->startPush('css'); ?>
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
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>


<section class="section-main bg padding-y-sm">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
        
                <div id="homeSlider" class="carousel slide" data-ride="carousel">
        
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-target="#homeSlider" data-slide-to="<?php echo e($key); ?>" class="<?php echo e($key == 0 ? 'active' : ''); ?>"></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
        
                    <!-- Slides -->
                    <div class="carousel-inner rounded">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                <a href="<?php echo e($slide->link); ?>">
                                    <img src="<?php echo e(asset('/public/'.$slide->image)); ?>"
                                         class="d-block w-100 slider-img"
                                         alt="">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php
            use App\Category;
            $menus = Menu::getByName('Category Menu');
        ?>
        
        <?php if($menus): ?>
        <div class="category-slider">
        
            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
                <?php
                    $cat = App\Category::where('categoryName','like',"%{$menu['label']}%")->first();
                ?>
        
                <div class="p-2">
                    <a href="<?php echo e($menu['link']); ?>" class="category-card text-center d-block">

                        <div class="category-img-box">
                    
                            <?php if(!empty($cat->categoryImage)): ?>
                                <img src="<?php echo e(asset('public/product/thumbnail/'.$cat->categoryImage)); ?>"
                                     class="category-img">
                            <?php else: ?>
                                 <div class="placeholder-icon">
                                    <i class="fa fa-image"></i>
                                </div>
                            <?php endif; ?>
                    
                        </div>
                    
                        <div class="category-name">
                            <?php echo e($menu['label']); ?>

                        </div>
                    
                    </a>
                </div>
        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        </div>
        <?php endif; ?>
    </div>
</section>

 
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="section-name bg padding-y-sm pt-0">
            <div class="container">
                <header class="section-heading mt-0">
                    <!-- Check if category exists before accessing properties -->
                    <?php if($section->category): ?>
                    
                        <a href="<?php echo e(url('/category/'.$section->category->categorySlug)); ?>" class="btn btn-info btn-sm float-right rounded">View More</a>
                        <h4 class="section-title"><?php echo e($section->category->categoryName); ?></h4>
                    <?php else: ?>
                        <h4 class="section-title">No Category Available</h4>
                    <?php endif; ?>
                </header><!-- sect-heading -->
                <div class="row no-gutters popular-product-slider">
                    <!-- Check if category and products exist -->
                    <?php if($section->category && $section->category->products->isNotEmpty()): ?>
                        <?php $__currentLoopData = $section->category->products->sortBy('productCode')->take($section->max); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <div class="card card-product-grid product-box-2">
                                    <a href="<?php echo e(url('/product/'.$product->productSlug)); ?>" class="img-wrap">
                                        <!-- Check if product image exists -->
                                        <img class="img-fit" src="<?php echo e(asset('/public/product/thumbnail/'.($product->productImage ?? 'default-image.jpg'))); ?>" alt="<?php echo e($product->productName ?? 'Product Name'); ?>">
                                        <?php if($product->isStockOut): ?>
                                    <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Stock Out</span>
                                <?php else: ?>
                                <?php if($product->isFreeDelivery): ?>
                                    <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Free Delivery</span>
                                <?php endif; ?>
                                <?php endif; ?>
                                    </a>
                                    <figcaption class="info-wrap">
                                        <!-- Check if product name exists -->
                                        <a href="<?php echo e(url('/product/'.$product->productSlug)); ?>" class="title text-truncate"><?php echo e($product->productName ?? 'Product Name'); ?></a>
                                        <div class="price mt-1 text-center">
                                            <!-- Check if htmlPrice() method exists -->
                                            <?php echo $product->htmlPrice() ?? 'Price Not Available'; ?>

                                        </div>
                                    </figcaption>
                                    <!-- Check for colors or sizes availability before showing buttons -->
                                    <?php if($product->colors->isNotEmpty() || $product->sizes->isNotEmpty() || $product->options->isNotEmpty()): ?>
                                        <a href="<?php echo e(url('/product/'.$product->productSlug)); ?>" class="btn btn-dark btn-sm btn-block <?php echo ($product->isStockOut)?'disabled':''; ?> "> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন</a>
                                    <?php else: ?>
                                        <!-- Check if product can be ordered -->
                                        <button <?php echo ($product->isStockOut)?'disabled':''; ?> class="btn btn-dark btn-sm btn-block" onclick="buyNow(<?php echo e($product->id); ?>)">
                                            <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No products available for this category.</p>
                    <?php endif; ?>
                </div>
            </div><!-- container // -->
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(Settings::get('home_page_all_products') == 'show'): ?>
    <section class="section-name bg padding-y-sm pt-0">
        <div class="container">
            <header class="section-heading mt-0">
                <a href="<?php echo e(url('/shop')); ?>" class="btn btn-info btn-sm float-right rounded">View More</a>
                <h4 class="section-title">Recommended For You</h4>
            </header>
            <div class="row no-gutters" id="loadProducts">


















            </div>
            <div class="loading" style=" display: flex; justify-content: center; align-items: center; ">
                <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M59.6 0h8v40h-8V0z" fill="#000000" fill-opacity="1"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(30 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(60 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(90 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#cccccc" fill-opacity="0.2" transform="rotate(120 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#b2b2b2" fill-opacity="0.3" transform="rotate(150 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#999999" fill-opacity="0.4" transform="rotate(180 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#7f7f7f" fill-opacity="0.5" transform="rotate(210 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#666666" fill-opacity="0.6" transform="rotate(240 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#4c4c4c" fill-opacity="0.7" transform="rotate(270 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#333333" fill-opacity="0.8" transform="rotate(300 64 64)"/><path d="M59.6 0h8v40h-8V0z" fill="#191919" fill-opacity="0.9" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="1080ms" repeatCount="indefinite"></animateTransform></g></svg>
            </div>



        </div>
    </section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
    <script>
        <?php if(Settings::get('home_page_all_products') == 'show'): ?>
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
        <?php endif; ?>

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


<?php $__env->stopPush(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html\resources\views/website/home.blade.php ENDPATH**/ ?>