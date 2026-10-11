<?php $__env->startSection('content'); ?>
    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h4 class="section-title"><?php echo e($category->categoryName); ?></h4>
            </header>
            <div class="lk-products-grid">
                <?php $__currentLoopData = $categoryProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('website.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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