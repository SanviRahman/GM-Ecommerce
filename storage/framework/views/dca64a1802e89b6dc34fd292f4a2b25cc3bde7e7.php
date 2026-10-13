
<?php
    $productUrl = url('/product/'.$product->productSlug);
    $hasVariants = $product->colors->isNotEmpty()
        || $product->sizes->isNotEmpty()
        || $product->options->isNotEmpty();
    $soldOut = $product->isSoldOut();
    $freeDelivery = (int) $product->isFreeDelivery === 1;
?>
<article class="lk-product-card">
    <a class="lk-product-card-image" href="<?php echo e($productUrl); ?>" aria-label="<?php echo e($product->productName); ?>">
        <img src="<?php echo e(\App\Support\PublicMedia::productOriginalUrl($product->productImage)); ?>"
             alt="<?php echo e($product->productName); ?>" loading="lazy">
        <?php echo $__env->make('website.partials.product_badge', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </a>
    <div class="lk-product-card-details">
        <a href="<?php echo e($productUrl); ?>" class="lk-product-card-name" title="<?php echo e($product->productName); ?>">
            <?php echo e($product->productName); ?>

        </a>
        <div class="lk-product-card-price"><?php echo $product->htmlPrice(); ?></div>
    </div>
    <?php if($soldOut): ?>
        <button class="lk-product-card-action" type="button" disabled>Sold out</button>
    <?php elseif($hasVariants): ?>
        <a class="lk-product-card-action" href="<?php echo e($productUrl); ?>">
            <?php echo e($freeDelivery ? 'ফ্রী ডেলিভারিতে অর্ডার করুন' : 'অর্ডার করুন'); ?>

        </a>
    <?php else: ?>
        <button class="lk-product-card-action" type="button" onclick="buyNow(<?php echo e($product->id); ?>)">
            <?php echo e($freeDelivery ? 'ফ্রী ডেলিভারিতে অর্ডার করুন' : 'অর্ডার করুন'); ?>

        </button>
    <?php endif; ?>
</article>
<?php /**PATH D:\public_html leatherket\resources\views/website/partials/product_card.blade.php ENDPATH**/ ?>