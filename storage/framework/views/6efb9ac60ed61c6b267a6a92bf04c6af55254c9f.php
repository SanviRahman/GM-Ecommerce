<?php $__env->startSection('content'); ?>

	<section class="section-name bg mt-2">
		<div class="container">
			<div class="card">
				<div class="row no-gutters single-product">
					<div class="col-md-5">
						<div id="single-product-galary" class="slider-home-banner carousel slide" data-ride="carousel">
							<div class="carousel-inner rounded">
								<div class="carousel-item active">
									<a href="javascript:void(0)" data-toggle="modal" data-target="#lightbox">
										<img src="<?php echo e(\App\Support\PublicMedia::url('product/'.$product->productImage)); ?>" alt="First slide" class="img-responsive img-thumbnail">
									</a>
								</div>
								<?php $__currentLoopData = $product->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="carousel-item">
    								<a href="javascript:void(0)" data-toggle="modal" data-target="#lightbox">
    									<img src="<?php echo e(\App\Support\PublicMedia::url('product/'.$photo->url)); ?>" alt="First slide" class="img-responsive img-thumbnail">
    								</a>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('website.partials.product_badge', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

							</div>
							<ol class="carousel-indicators">
								<li data-target="#single-product-galary" data-slide-to="0" class="active">
									<img class="img-thumbnail" alt="" src="<?php echo e(\App\Support\PublicMedia::url('product/thumbnail/'.$product->productImage)); ?>">
								</li>
								<?php $__currentLoopData = $product->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li data-target="#single-product-galary" data-slide-to="<?php echo e($index+1); ?>">
								    <img class="img-thumbnail" alt="" src="<?php echo e(\App\Support\PublicMedia::url('product/thumbnail/'.$photo->url)); ?>">
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
							</ol>
						</div>
					</div>
					<div class="col-md-7 border-left">
						<div class="content-body">
							<h4 class="title"><?php echo e($product->productName); ?></h4>
							<div class="row">
							    
                                <?php if($product->colors->isNotEmpty()): ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label d-block font-weight-bolder">Select Color</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <?php $__currentLoopData = $product->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="btn btn-outline-secondary <?php echo e($index === 0 ? 'active' : ''); ?>">
                                                    <input 
                                                        type="radio" 
                                                        name="color" 
                                                        id="color-<?php echo e($color->id); ?>" 
                                                        value="<?php echo e($color->id); ?>" 
                                                        autocomplete="off" 
                                                        <?php echo e($index === 0 ? 'checked' : ''); ?>

                                                    >
                                                    <?php echo e($color->colorName); ?>

                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($product->sizes->isNotEmpty()): ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label d-block font-weight-bolder">Select Size</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="btn btn-outline-secondary <?php echo e($index === 0 ? 'active' : ''); ?>">
                                                    <input 
                                                        type="radio" 
                                                        name="size" 
                                                        id="size-<?php echo e($size->id); ?>" 
                                                        value="<?php echo e($size->id); ?>" 
                                                        autocomplete="off" 
                                                        <?php echo e($index === 0 ? 'checked' : ''); ?>

                                                    >
                                                    <?php echo e($size->sizeName); ?>

                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($product->options->isNotEmpty()): ?>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label d-block font-weight-bolder">Select Option</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <?php $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="btn btn-outline-secondary <?php echo e($index === 0 ? 'active' : ''); ?>">
                                                    <input 
                                                        type="radio" 
                                                        name="option" 
                                                        id="option-<?php echo e($option->id); ?>" 
                                                        value="<?php echo e($option->id); ?>" 
                                                        autocomplete="off" 
                                                        <?php echo e($index === 0 ? 'checked' : ''); ?>

                                                         onchange="
                                                            document.getElementById('product-price').textContent = '৳ ' + Number(<?php echo e((float) $option->pivot->price); ?>).toLocaleString('en-BD', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                                                        "
                                                    >
                                                    <?php echo e($option->optionName); ?>

                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div> <!-- options row -->
                            <div class="leatherket-purchase-panel">
                                <div class="leatherket-inventory mb-3" role="status">
                                    <?php if($product->isSoldOut()): ?>
                                        <span class="leatherket-stock-label leatherket-stock-empty"><i class="fa fa-times" aria-hidden="true"></i> Sold out</span>
                                    <?php else: ?>
                                        <span class="leatherket-stock-label"><i class="fa fa-check" aria-hidden="true"></i> <?php echo e($product->availableStock()); ?> <?php echo e($product->availableStock() === 1 ? 'product' : 'products'); ?> in stock</span>
                                    <?php endif; ?>
                                </div>
                                <div class="leatherket-detail-price mb-4" id="product-price"><?php echo $product->htmlPrice(); ?></div>
                                <label for="leatherket-product-quantity" class="leatherket-quantity-label">Quantity:</label>
                                <div class="input-group input-spinner leatherket-quantity-spinner mb-4">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-light lk-qty-btn" type="button" data-type="minus" data-field="quantity" aria-label="Decrease quantity" <?php echo e($product->isSoldOut() ? 'disabled' : ''); ?>>−</button>
                                    </div>
                                    <input type="number" id="leatherket-product-quantity" class="form-control lk-qty-input" value="1" name="quantity" min="1" max="<?php echo e(max(1, min(10, $product->availableStock()))); ?>" inputmode="numeric" aria-label="Quantity" <?php echo e($product->isSoldOut() ? 'disabled' : ''); ?>>
                                    <div class="input-group-append">
                                        <button class="btn btn-light lk-qty-btn" type="button" data-type="plus" data-field="quantity" aria-label="Increase quantity" <?php echo e($product->isSoldOut() ? 'disabled' : ''); ?>>+</button>
                                    </div>
                                </div>
                                <div class="single-product-buttons leatherket-purchase-buttons">
                                    <button type="button" <?php echo e($product->isSoldOut() ? 'disabled' : ''); ?> class="btn btn-primary leatherket-add-cart" onclick="addToCart(<?php echo e($product->id); ?>)">Add to cart</button>
                                    <button type="button" <?php echo e($product->isSoldOut() ? 'disabled' : ''); ?> class="btn btn-outline-primary leatherket-buy-now" onclick="buyNow(<?php echo e($product->id); ?>)">Buy it now</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12  col-xs-12" style="padding: 0">
                                <?php echo Settings::get('product_bottom_text'); ?>

                            </div>
                            <?php
                                $shipingCharges = App\ShippingCharge::all();
                            ?>
                            <?php if($shipingCharges->isNotEmpty()): ?>
                            <table class="table mt-2">
								<tbody>
                                
                                    <?php $__currentLoopData = $shipingCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shipingCharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
									  <td>
										 <?php echo e($shipingCharge->name); ?>

									  </td>
									  <td>
										 <b>৳  <?php echo e($shipingCharge->charge); ?></b>
									  </td>
								   </tr>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
							 </table>
                            <?php else: ?>
                                <p>No shipping charges available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
				</div>
            
			<div class="card mt-2">
				<div class="card-body">
					<div class="tabs tabs--style-2">
						<ul class="bor-rtop-lr  nav nav-tabs sticky-top bg-white">
							<li class="nav-item">
								<a href="#tab_default_1" data-toggle="tab" class="nav-link text-uppercase strong-600 active show">Description</a>
							</li>
						</ul>
						<div class="tab-content pt-0">
							<div class="tab-pane active show p-2" id="tab_default_1">
                                <?php echo $product->productDetails; ?>

							</div>
						  </div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h4 class="section-title">Related products</h4>
            </header>
            <div class="row no-gutters">
                <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-6">
                        <div href="#" class="card card-product-grid product-box-2">
                            <a href="<?php echo e(url('/product/'.$prod->id)); ?>" class="img-wrap">
                                <img class="img-fit lazyload"   src="<?php echo e(\App\Support\PublicMedia::url('product/thumbnail/'.$prod->productImage)); ?>" data-src="<?php echo e(\App\Support\PublicMedia::url('product/thumbnail/'.$prod->productImage)); ?>" alt="<?php echo e($prod->productName); ?>">
                                <?php echo $__env->make('website.partials.product_badge', ['product' => $prod], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </a>
                            <figcaption class="info-wrap">
                                <a href="<?php echo e(url('/product/'.$prod->id)); ?>" class="title text-truncate"><?php echo e($prod->productName); ?></a>
                                <div class="price mt-1 text-center">
                                    <?php echo $prod->htmlPrice(); ?>

                                </div>
                            </figcaption>
                            <?php if($prod->colors->isNotEmpty() || $prod->sizes->isNotEmpty() || $prod->options->isNotEmpty()): ?>
                                <a href="<?php echo e(url('/product/'.$prod->productSlug)); ?>" class="btn btn-success btn-sm btn-block <?php echo e($prod->isSoldOut() ? 'disabled' : ''); ?>"> <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন</a>
                            <?php else: ?>
                            <button <?php echo e($prod->isSoldOut() ? 'disabled' : ''); ?> class="btn btn-success btn-sm btn-block" onclick="addToCart(<?php echo e($prod->id); ?>)">
                                <i class="fa fa-shopping-cart"  aria-hidden="true"></i> অর্ডার করুন
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section> 

    <div id="lightbox" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-middle">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <img class="img-responsive img-thumbnail" src="" alt="" />
                </div>
            </div>
        </div>
    </div>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: "view_item",
        value:"<?php echo e($product->productSalePrice); ?>",
        ecommerce: {
            items: [{
                item_name: "<?php echo e($product->productName); ?>", // Product Name
                item_id: "<?php echo e($product->id); ?>", // Product ID
                price: "<?php echo e($product->productSalePrice); ?>", // Product Price
                item_category: "<?php echo e($product->category->name ?? 'Uncategorized'); ?>", // Product Category
                item_variant: "<?php echo e($product->colors->first()->colorName ?? ''); ?> <?php echo e($product->sizes->first()->sizeName ?? ''); ?>", // Default Variant
                quantity: 1,
                currency: "BDT"
            }]
        }
    });
    </script>
    <script>
    fbq('track', 'ViewContent', {
        content_ids: ["<?php echo e($product->id); ?>"], // Product ID
        content_name: "<?php echo e($product->productName); ?>", // Product Name
        content_category: "<?php echo e($product->category->name ?? 'Uncategorized'); ?>", // Category
        value: "<?php echo e($product->productSalePrice); ?>", // Price
        currency: "BDT"
    });
    </script>

<script>
    (function () {
        var input = document.querySelector('#leatherket-product-quantity');
        if (!input) return;
        var holder = input.closest('.leatherket-quantity-spinner');
        holder.querySelectorAll('.lk-qty-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                if (input.disabled) return;
                var min = Number(input.min) || 1;
                var max = Number(input.max) || 10;
                var value = Math.min(max, Math.max(min, Number(input.value) || 1));
                input.value = Math.min(max, Math.max(min, value + (button.dataset.type === 'plus' ? 1 : -1)));
            });
        });
        input.addEventListener('change', function () {
            input.value = Math.min(Number(input.max) || 10, Math.max(1, Number(input.value) || 1));
        });
    }());
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html leatherket\resources\views/website/product.blade.php ENDPATH**/ ?>