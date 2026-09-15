<?php
    $campaignDeliveryCharge = isset($_SESSION['delivery']) ? (float) $_SESSION['delivery'] : 0;

    // hardevine/shoppingcart regenerates rowId when item options change and
    // re-inserts that row at the end of the cart collection. Render campaign
    // items by their original campaign position so option changes never move
    // Product 1 / Product 2 / Product 3 around.
    $campaignCartItems = Cart::content()->sortBy(function ($item) {
        return (int) ($item->options->campaignPosition ?? PHP_INT_MAX);
    });

    // Match the normal checkout free-delivery rule: if any selected campaign
    // product has free delivery, the delivery charge is shown and then fully
    // discounted for the entire campaign order.
    $campaignHasFreeDelivery = $campaignCartItems->contains(function ($item) {
        return $item->model && (int) $item->model->isFreeDelivery === 1;
    });
    $campaignFreeDeliveryDiscount = $campaignHasFreeDelivery ? $campaignDeliveryCharge : 0;
    $campaignSubtotal = (float) Cart::subtotal('0', '', '');
    $campaignGrandTotal = $campaignSubtotal + $campaignDeliveryCharge - $campaignFreeDeliveryDiscount;
?>
<aside class="card">
    <article class="card-body">
        <header class="mb-4">
            <h4 class="card-title" style="font-size: 16px;">আপনার অর্ডার</h4>
        </header>
        <div class="row">
            <div class="table-responsive bg-white">
                <table class="table border-bottom campaign-order-table">
                    <thead>
                    <tr>
                        <th class="product-image">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-total">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $campaignCartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $selectedOptionId = $item->options->optionId ?? null;
                            $selectedOptionName = $item->options->optionName ?? null;
                            $selectedColorId = $item->options->colorId ?? null;
                            $selectedColorName = $item->options->colorName ?? null;
                        ?>
                        <tr class="cart-item campaign-tracking-item"
                            data-product-id="<?php echo e($item->id); ?>"
                            data-product-code="<?php echo e($item->model->productCode); ?>"
                            data-product-name="<?php echo e($item->model->productName); ?>"
                            data-price="<?php echo e((float) $item->price); ?>"
                            data-quantity="<?php echo e((int) $item->qty); ?>"
                            data-category="<?php echo e(optional($item->model->category)->name ?? 'Uncategorized'); ?>"
                            data-color="<?php echo e($selectedColorName ?? ''); ?>"
                            data-size="<?php echo e($item->options->sizeName ?? ''); ?>"
                            data-option="<?php echo e($selectedOptionName ?? ''); ?>">
                            <td class="product-image" style="display: flex; flex-direction: row-reverse;">
                                <a href="#">
                                    <img class="lazyload" src="<?php echo e(url('/public/product/thumbnail/'.$item->model->productImage)); ?>" style="max-width: 50px">
                                </a>
                                <button type="button" onclick="removeCampaignProduct('<?php echo e($item->id); ?>')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>

                            <td class="product-name">
                                <span class="d-block">
                                    <?php echo e($item->model->productName); ?>

                                    <?php if((int) $item->model->isFreeDelivery === 1): ?>
                                        <span class="badge badge-danger ml-1" style="font-size: 10px;">Free Delivery</span>
                                    <?php endif; ?>
                                </span>

                                <?php if($item->model->colors->isNotEmpty()): ?>
                                    <div class="mt-2 campaign-color-selector">
                                        <small class="d-block mb-1 font-weight-bold">Select Color</small>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <?php $__currentLoopData = $item->model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $isSelectedColor = $selectedColorId
                                                        ? ((int) $selectedColorId === (int) $color->id)
                                                        : ($selectedColorName === $color->colorName);
                                                ?>
                                                <label class="btn btn-outline-secondary btn-sm mb-1 <?php echo e($isSelectedColor ? 'active' : ''); ?>">
                                                    <input
                                                        type="radio"
                                                        name="campaign_color_<?php echo e($item->rowId); ?>"
                                                        value="<?php echo e($color->id); ?>"
                                                        autocomplete="off"
                                                        <?php echo e($isSelectedColor ? 'checked' : ''); ?>

                                                        onchange="updateCampaignColor('<?php echo e($item->rowId); ?>', this.value)"
                                                    >
                                                    <?php echo e($color->colorName); ?>

                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php elseif($selectedColorName): ?>
                                    <small class="text-muted">Color: <?php echo e($selectedColorName); ?>,</small>
                                <?php endif; ?>

                                <?php if($item->options->sizeName): ?>
                                    <small class="text-muted">Size: <?php echo e($item->options->sizeName); ?>,</small>
                                <?php endif; ?>

                                <?php if($item->model->options->isNotEmpty()): ?>
                                    <div class="mt-2 campaign-option-selector">
                                        <small class="d-block mb-1 font-weight-bold">Select Option</small>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <?php $__currentLoopData = $item->model->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $isSelectedOption = $selectedOptionId
                                                        ? ((int) $selectedOptionId === (int) $option->id)
                                                        : ($selectedOptionName === $option->optionName);
                                                ?>
                                                <label class="btn btn-outline-secondary btn-sm mb-1 <?php echo e($isSelectedOption ? 'active' : ''); ?>">
                                                    <input
                                                        type="radio"
                                                        name="campaign_option_<?php echo e($item->rowId); ?>"
                                                        value="<?php echo e($option->id); ?>"
                                                        autocomplete="off"
                                                        <?php echo e($isSelectedOption ? 'checked' : ''); ?>

                                                        onchange="updateCampaignOption('<?php echo e($item->rowId); ?>', this.value)"
                                                    >
                                                    <?php echo e($option->optionName); ?>

                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php elseif($selectedOptionName): ?>
                                    <small class="text-muted">Option: <?php echo e($selectedOptionName); ?></small>
                                <?php endif; ?>
                            </td>

                            <td class="product-price">
                                <span class="d-block">TK <?php echo e(number_format((float) $item->price, 0, '.', '')); ?></span>
                            </td>

                            <td class="product-quantity">
                                <div class="input-group input-spinner">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-light btn-number" type="button" data-type="plus" data-field="quantity[<?php echo e($item->id); ?>]"> + </button>
                                    </div>
                                    <input type="text" name="quantity[<?php echo e($item->id); ?>]" class="form-control input-number" placeholder="1" value="<?php echo e($item->qty); ?>" min="1" max="10" onchange="updateQuantity('<?php echo e($item->rowId); ?>', this)">
                                    <div class="input-group-append">
                                        <button class="btn btn-light btn-number" type="button" data-type="minus" data-field="quantity[<?php echo e($item->id); ?>]"> − </button>
                                    </div>
                                </div>
                            </td>
                            <td class="product-total">
                                <span>TK <?php echo e(number_format((float) $item->subtotal, 0, '.', '')); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </article>
    <article class="card-body border-top">
        <dl class="row">
            <dt class="col-sm-8">Subtotal: </dt>
            <dd class="col-sm-4 text-right"><strong>TK <?php echo e(Cart::subtotal('0', '', '')); ?></strong></dd>

            <dt class="col-sm-8">Delivery charge: </dt>
            <dd class="col-sm-4 text-danger text-right"><strong>TK <?php echo e(number_format($campaignDeliveryCharge, 0, '.', '')); ?></strong></dd>

            <dt class="col-sm-8">Discount: </dt>
            <dd class="col-sm-4 text-success text-right"><strong>- TK <?php echo e(number_format($campaignFreeDeliveryDiscount, 0, '.', '')); ?></strong></dd>

            <dt class="col-sm-8">Total:</dt>
            <dd class="col-sm-4 text-right">
                <strong class="h5 text-dark">TK <?php echo e(number_format($campaignGrandTotal, 0, '.', '')); ?></strong>
            </dd>
        </dl>
    </article>
    <script type="text/javascript">
        cartQuantityInitialize();
    </script>
</aside>
<?php /**PATH D:\public_html\resources\views/website/partials/campaign_order_details.blade.php ENDPATH**/ ?>