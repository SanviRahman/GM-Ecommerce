<?php $__env->startSection('content'); ?>
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="card py-3 mt-sm-3">
                    <div class="card-body text-center table-responsive">
                        <h2 class="h4 pb-3" style="color:black">আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে আমাদের কল সেন্টার থেকে ফোন করে আপনার অর্ডারটি কনফার্ম করা হবে</h2>
                        
                        <h2 class="h4 pb-3" style="color:red">কল সেন্টার ফোন নাম্বর  <br>
                        <?php echo Settings::get('checkout_number_text'); ?>

                        </h2>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5">Invoive ID : <?php echo e($order->invoiceID); ?></th>
                              
                            </tr>
                            <tr>
                                <th class="text-left">Product Name</th>
                                <th>Code</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0 ?>
                            <?php $__currentLoopData = $orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-left">
                                    <span class="d-block"><?php echo e($product->productName); ?></span>
                                    <?php if(!empty($product->colorName)): ?>
                                        <small class="text-muted"> Color: <?php echo e($product->colorName); ?> ,</small>
                                    <?php endif; ?>
                                    <?php if(!empty($product->sizeName)): ?>
                                        <small class="text-muted"> Size: <?php echo e($product->sizeName); ?> ,</small>
                                    <?php endif; ?>
                                    <?php if(!empty($product->optionName)): ?>
                                        <small class="text-muted"> Option: <?php echo e($product->optionName); ?> </small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($product->productCode); ?></td>
                                <td><?php echo e($product->quantity); ?></td>
                                <td><?php echo e($product->productPrice); ?></td>
                                <td><?php echo e($product->quantity * $product->productPrice); ?></td>
                                <?php $total += $product->quantity * $product->productPrice ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Delivery Charge</th>
                                <th><?php echo e($order->deliveryCharge); ?></th>
                                <?php $total += $order->deliveryCharge ?>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th><?php echo e($total); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                        
                        <a class="btn btn-primary mt-3" href="<?php echo e(url('/')); ?>">প্রোডাক্ট বাছাই করুন</a>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {

            $('#selectCourier').on('change',function (e) {
                var selectCourier = +$('#selectCourier option:selected').val();
                $.ajax({
                    type: "get",
                    url: "<?php echo e(url('/updateDeliveryCharge')); ?>",
                    data: {
                        'selectCourier':selectCourier,
                        '_token': '<?php echo e(csrf_token()); ?>'
                    },
                    success: function () {
                        updateQuantity(0,0);
                    }
                });
            });

            $(document).on("click", "#orderConfirm", function () {
                constantValue = 0;
                var customerName = $('#customerName');
                var customerAddress = $('#customerAddress');
                var customerPhone = $('#customerPhone');
                var selectCourier = $('#selectCourier option:selected');
                if (!customerName.val()) {
                    customerName.addClass("has-error");
                    constantValue = 1;
                }
                if (!customerAddress.val()) {
                    customerAddress.addClass("has-error");
                    constantValue = 1;
                }
                if (!customerPhone.val()) {
                    customerPhone.addClass("has-error");
                    constantValue = 1;
                }
                console.log(selectCourier.val())
                if (selectCourier.val() === '') {
                    selectCourier.addClass("has-error");
                    showFrontendAlert('error', 'Unsuccessful to Place order');
                    constantValue = 1;
                }
                if (constantValue === 1) {
                    $('html, body').animate(  {  scrollTop: $('body').position().top  },  500   );
                } else {
                    $.ajax({
                        type: "post",
                        url: "<?php echo e(url('/placeOrder')); ?>",
                        data: {
                            'customerName': customerName.val(),
                            'customerAddress': customerAddress.val(),
                            'customerPhone': customerPhone.val(),
                            'selectCourier': selectCourier.val(),
                            '_token': '<?php echo e(csrf_token()); ?>'
                        },
                        success: function (data) {
                            if(data['status'] === 'success'){
                                showFrontendAlert('success', 'Successfully Place order');
                                window.location.href = data['link'];

                            }else{
                                showFrontendAlert('error', 'Unsuccessful to Place order');

                            }
                        }
                    });
                }
            });
        });
    </script>
    <?php
        $purchaseItems = [];
        $purchaseContentIds = [];

        foreach ($orderProducts as $purchaseProduct) {
            $purchaseVariant = trim(implode(' ', array_filter([
                $purchaseProduct->colorName ?? null,
                $purchaseProduct->sizeName ?? null,
                $purchaseProduct->optionName ?? null,
            ])));

            $purchaseItems[] = [
                'id' => (string) $purchaseProduct->productCode,
                'name' => (string) $purchaseProduct->productName,
                'category' => $purchaseProduct->category ?? 'Uncategorized',
                'variant' => $purchaseVariant,
                'price' => (float) $purchaseProduct->productPrice,
                'quantity' => (int) $purchaseProduct->quantity,
            ];
            $purchaseContentIds[] = (string) $purchaseProduct->productCode;
        }
    ?>
    <script>
        window.dataLayer = window.dataLayer || [];

        var orderValue = <?php echo e((float) $total); ?>;
        var orderId = <?php echo json_encode((string) $order->id); ?>;
        var orderCurrency = 'BDT';
        var purchaseItems = <?php echo json_encode($purchaseItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        var purchaseContentIds = <?php echo json_encode($purchaseContentIds, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

        // Clear stale ecommerce state, then send every saved order product.
        window.dataLayer.push({ ecommerce: null });
        window.dataLayer.push({
            event: 'purchase',
            ecommerce: {
                transaction_id: orderId,
                affiliation: 'Online Store',
                value: orderValue,
                currency: orderCurrency,
                coupon: <?php echo json_encode($order->coupon ?? 'N/A'); ?>,
                items: purchaseItems
            },
            user_data: {
                email: <?php echo json_encode($customer->customerName ?? ''); ?>,
                phone: <?php echo json_encode($customer->customerPhone ?? ''); ?>,
                address: <?php echo json_encode($customer->customerAddress ?? ''); ?>

            }
        });

        if (typeof fbq === 'function') {
            fbq('track', 'Purchase', {
                content_ids: purchaseContentIds,
                contents: purchaseItems.map(function (item) {
                    return {
                        id: item.id,
                        quantity: item.quantity,
                        item_price: item.price
                    };
                }),
                content_name: 'Order Confirmation',
                content_category: 'Products',
                num_items: purchaseItems.reduce(function (totalItems, item) {
                    return totalItems + Number(item.quantity || 0);
                }, 0),
                value: orderValue,
                currency: orderCurrency
            });
        }
    </script>
    <script>
        setTimeout(function() {
            window.location.href = "<?php echo e(url('/')); ?>"; // Laravel blade
            // অথবা শুধু "/" ব্যবহার করুন যদি সরাসরি root redirect করতে চান
            // window.location.href = "/";
        }, 200000); // 2000 milliseconds = 2 seconds
    </script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('website.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html leatherket\resources\views/website/thankyou.blade.php ENDPATH**/ ?>