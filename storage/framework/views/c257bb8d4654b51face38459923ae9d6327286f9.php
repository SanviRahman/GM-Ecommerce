<?php $__env->startSection('content'); ?>
    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h4 class="section-title"><?php echo e($category->categoryName); ?></h4>
            </header>
            <div class="row no-gutters">
                <?php $__currentLoopData = $categoryProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-2 col-6">
                        <div href="#" class="card card-product-grid product-box-2">
                            <a href="<?php echo e(url('/product/'.$product->productSlug)); ?>" class="img-wrap">
                                <img class="img-fit lazyload"   src="<?php echo e(\App\Support\PublicMedia::url('product/thumbnail/'.$product->productImage)); ?>" data-src="<?php echo e(\App\Support\PublicMedia::url('product/thumbnail/'.$product->productImage)); ?>" alt="<?php echo e($product->productName); ?>">
                                        <?php echo $__env->make('website.partials.product_badge', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </a>
                            <figcaption class="info-wrap">
                                <a href="<?php echo e(url('/product/'.$product->productSlug)); ?>" class="title text-truncate"><?php echo e($product->productName); ?></a>
                                <div class="price mt-1 text-center">
                                    <?php echo $product->htmlPrice(); ?>

                                </div>
                            </figcaption>
                            <?php if($product->colors->isNotEmpty() || $product->sizes->isNotEmpty() || $product->options->isNotEmpty()): ?>
                                <a  href="<?php echo e(url('/product/'.$product->productSlug)); ?>" class="btn btn-dark btn-sm btn-block <?php echo ($product->isSoldOut())?'disabled':''; ?> "> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> <?php echo e((int) $product->isFreeDelivery === 1 ? 'ফ্রী ডেলিভারিতে অর্ডার করুন' : 'অর্ডার করুন'); ?></a>
                            <?php else: ?>
                            <button <?php echo ($product->isSoldOut())?'disabled':''; ?>  class="btn btn-dark btn-sm btn-block" onclick="addToCart(<?php echo e($product->id); ?>)">
                                <i class="fa fa-shopping-cart"  aria-hidden="true"></i> <?php echo e((int) $product->isFreeDelivery === 1 ? 'ফ্রী ডেলিভারিতে অর্ডার করুন' : 'অর্ডার করুন'); ?>

                            </button>
                            <?php endif; ?>
                        </div>
                    </div> <!-- col.// -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div style=" display: flex; justify-content: center; margin-top: 39px; ">
                <?php echo e($categoryProducts->links()); ?>

            </div>
        </div>
    </section>
    <script>
      fbq('track', 'ViewContent', {
        content_name: '<?php echo e($category->categoryName); ?>',
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
        'categoryName': '<?php echo e($category->categoryName); ?>',
        'ecommerce': {
            'currency': 'BDT',
            'value': 0
        }
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html leatherket\resources\views/website/category.blade.php ENDPATH**/ ?>