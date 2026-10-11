<?php if($product->isSoldOut()): ?>
    <span class="leatherket-product-badge leatherket-badge-sold">Sold out</span>
<?php elseif($product->salePercentage() > 0): ?>
    <span class="leatherket-product-badge leatherket-badge-sale"><?php echo e($product->salePercentage()); ?>% Sale</span>
<?php elseif($product->isFreeDelivery): ?>
    <span class="leatherket-product-badge leatherket-badge-delivery">Free Delivery</span>
<?php endif; ?>
<?php /**PATH D:\public_html leatherket\resources\views/website/partials/product_badge.blade.php ENDPATH**/ ?>