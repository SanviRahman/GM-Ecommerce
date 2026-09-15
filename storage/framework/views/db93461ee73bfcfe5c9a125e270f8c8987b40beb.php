<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>">

    <title><?php echo e(Settings::get('site_name')); ?></title>

    <script src="<?php echo e(asset('assets/js/jquery-2.0.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <link href="<?php echo e(asset('assets/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/fonts/fontawesome/css/all.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/ui.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/responsive.css')); ?>" rel="stylesheet" type="text/css"  media="only screen and (max-width: 1200px)"  />
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
    <link type="text/css" href="<?php echo e(asset('assets/css/sweetalert2.min.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo Settings::get('facebook_pixels'); ?>

    <!-- CSS for scrolling ticker -->

</head>

<body>   
  <div style="background-color:black; color:white;">
    <div class="container d-flex align-items-center py-2">
        <!-- Left side: Hotline -->
        <div class="me-4 d-flex align-items-center " style="min-width:210px">
            <i class="fas fa-headset me-2"></i> 
            কল করুন: 
            <a class="text-white ms-1 pr-4" href="tel:<?php echo e(Settings::get('phone_number')); ?>">
                <?php echo e(Settings::get('phone_number')); ?> 
            </a>
        </div>

        <!-- Right side: Scrolling news ticker -->
        <div class="flex-grow-1 overflow-hidden">
            <marquee behavior="scroll" direction="left" scrollamount="5">
                ⚡  LEATHERKET ওয়েবসাইটে আপনাকে সাগতম &nbsp;&nbsp;|&nbsp;&nbsp; 
                প্রোডাক্ট অবশ্যই চেক করে রিসিভ করবেন &nbsp;&nbsp;|&nbsp;&nbsp; 
                ক্যান্সেল করলে ডেলিভারি চার্জ দিয়ে রিটার্ন করতে হবে ⚡ 
            </marquee>
        </div>
    </div>
</div>





    
<div class="mobile-side-menu d-lg-none hide">
    <div class="side-menu-overlay " onclick="sideMenuClose()"></div>
    <div class="side-menu-wrap">
        <div class="side-menu closed">
            <div class="d-flex px-3 py-3 align-items-center bg-success" style=" justify-content: space-between; ">
                <div class="widget-profile-box  d-flex align-items-center">

                    <img class="logo" src="<?php echo e(asset('/public/'.Settings::get('site_logo'))); ?>" alt="<?php echo e(Settings::get('site_name')); ?>" style="    max-width: 100px;" class="w-50">
                </div>
                <div class="side-menu-close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
            <div class="side-menu-list px-3" style="max-height: 90vh;overflow-y: auto;">
                
                <ul>
                    
                    <?php $category = Menu::getByName('Category Menu') ?>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="">
                                <a href="<?php echo e($menu['link']); ?>" title=""><i class="fa fa-dot-circle-o"></i> <?php echo e($menu['label']); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="tel:<?php echo e(Settings::get('phone_number')); ?>" class="">
                            <i class="fa fa-phone"></i>
                            <span class="category-name"> <?php echo e(Settings::get('phone_number')); ?> </span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>

<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center">
                    <button class="navbar-toggler menu-toggle d-lg-none d-block mr-2" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a href="<?php echo e(url('/')); ?>" class="brand-wrap">
                        <img class="logo" src="<?php echo e(asset('/public/'.Settings::get('site_logo'))); ?>" alt="<?php echo e(Settings::get('site_name')); ?>">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-9 col-md-5 col-sm-12 search-box">
                    <form action="<?php echo e(url('/shop')); ?>" class="search">
                        <div class="input-group w-100">
                            <div class="d-sm-none search-box-back">
                                <button class="" type="button"><i class="fa fa-arrow-left"></i></button>
                            </div>
                            <input type="text" name="q" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-lg-1 col-md-3 col-sm-6 col-6">
                    <div class="widgets-wrap float-right">
                        <div class="widget-header mr-4 nav-search-box d-lg-none">
                            <a href="#" class="icon icon-xs rounded-circle border"><i class="fa fa-search"
                                                                                      aria-hidden="true"></i></a>
                        </div>
                        <div class="widget-header">

                            <div class="nav-cart-box dropdown" id="cart_items">
                                <span class="badge badge-pill badge-danger notify">0</span>
                                <a href="" class="icon icon-xs rounded-circle border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-shopping-cart d-inline-block nav-box-icon"></i>
                                    <span class="badge badge-pill badge-danger notify">0</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right px-0" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-328px, 32px, 0px);">

                                    <li>
                                        <div class="dropdown-cart px-0">
                                            <div class="dc-header">
                                                <h4 class="text-center py-2">Empty Cart</h4>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
<style>
    .navbar-nav{
      flex-wrap: nowrap;
      overflow-x: auto;
      white-space: nowrap;
      scrollbar-width: none;        /* Firefox */
    }
    
    .navbar-nav::-webkit-scrollbar{
      display: none;                 /* Chrome, Safari */
    }
</style>
<?php $header = Menu::getByName('Header Menu') ?>
<?php if($header): ?>
<nav class="navbar navbar-main navbar-expand-sm navbar-light border-bottom d-none d-sm-block">
    <div class="container">
        <div class="collapse navbar-collapse" id="main_nav" style="overflow-x:auto; white-space:nowrap;">
            <ul class="navbar-nav  flex-nowrap">
                <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo e($menu['link']); ?>"><?php echo e($menu['label']); ?></a>
                    <?php if( $menu['child'] ): ?>
                    <div class="dropdown-menu">
                        <?php $__currentLoopData = $menu['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item" href="<?php echo e($child['link']); ?>"><?php echo e($child['label']); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<footer class="section-footer border-top">
    <div class="container">
        <?php $footer = Menu::getByName('Footer Menu') ?>
        <?php if($footer): ?>
        <section class="footer-top  padding-top-sm padding-bottom-sm">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0 text-center">
                        <?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($menu['link']); ?>"><?php echo e($menu['label']); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                </div>
            </div>
        </section>
            <?php endif; ?>
        <section class="footer-bottom border-top row">
            <div class="col-md-2">
                <p class="text-muted"> <?php echo date("Y"); ?> &copy  <?php echo e(Settings::get('site_name')); ?> </p>
            </div>
            <div class="col-md-6 text-md-center">
                <?php echo Settings::get('footer_copyright_text'); ?> 
            </div>
            <div class="col-md-4 text-md-right text-muted">
               Design & Developed By <a href="https://digitalvai.com/" target="_blank">DIGITAL VAI</a> 
            </div>
        </section>
    </div>
</footer>
<script src="<?php echo e(asset('assets/js/lazyload.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
<script>
    $(document).ready(function() {
        updateNavCart();
    
    });
    function showFrontendAlert(type, message) {
        if (type === 'danger') {
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
    function updateNavCart() {
        
        $.ajax({
            type: "get",
            url: "<?php echo e(url('/mini-cart-view')); ?>",
            contentType: "application/json",
            success: function (response) {
                $('#cart_items').empty().html(response);
               
            }
        });
    }

    function removeFromCart(key) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            type: "DELETE",
            url: "<?php echo e(url('/checkout')); ?>/" + key,
            data: {
                '_token': '<?php echo e(csrf_token()); ?>'
            },
            contentType: "application/json",
            success: function (response) {

                showFrontendAlert('success', 'Successfully Product Removed from Cart');
                updateNavCart();
                updateQuantity(key,0);
                if(response['reload'] === 'true'){
                    location.reload();
                }

            }
        });
    }

    function updateQuantity(key, element){
        $.get("<?php echo e(url('/updateQuantity')); ?>", { _token:'30aK3OPPMnzZeq8BKYZGsidbBTm5VsnwPGhJdtPl', key:key, quantity: element.value}, function(data){
            updateNavCart();
            $('.orderDetails').html(data);
        });
    }
    function updateCartOptions(key, value, optionType) {
      
        $.get("<?php echo e(route('updateCartOptions')); ?>", {
            _token: '<?php echo e(csrf_token()); ?>', // Include CSRF token
            key: key,
            [optionType] : value
        }, function(data) {
            updateNavCart(); // Update the navigation cart
            $('.orderDetails').html(data); // Update the order details with the new cart HTML
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error updating cart options:', textStatus, errorThrown);
            alert('Could not update cart options. Please try again.');
        });
    }

    function addToCart(id) {
        var colorId = $('input[name="color"]:checked').val();
        var sizeId = $('input[name="size"]:checked').val();
        var optionId = $('input[name="option"]:checked').val();
        var quantity = $('input[name="quantity"]').val() || 1;
        $.post("<?php echo e(url('/checkout')); ?>", {
            _token: '<?php echo e(csrf_token()); ?>',
            id: id,
            quantity: quantity,
            color_id: colorId,
            size_id: sizeId,
            option_id: optionId
        }, function (data) {
            console.log(data.message);
            showFrontendAlert(data.status, data.message);
            updateNavCart();
          
        });
    }

    function buyNow(id) {
        var colorId = $('input[name="color"]:checked').val();
        var sizeId = $('input[name="size"]:checked').val();
        var quantity = $('input[name="quantity"]').val() || 1;
        var optionId = $('input[name="option"]:checked').val();
       // Check if color and size are selected
        if ($('#color-select').length && !colorId) {
            showFrontendAlert('error', 'Please select a color.');
            return;
        }

        if ($('#size-select').length && !sizeId) {
            showFrontendAlert('error', 'Please select a size.');
            return;
        }
        $.post("<?php echo e(url('/checkout')); ?>", {
            _token: '<?php echo e(csrf_token()); ?>',
            id: id,
            quantity: quantity,
            color_id: colorId,
            size_id: sizeId,
            option_id: optionId
        }, function (data) {
            showFrontendAlert(data.status, data.message);
            updateNavCart();
            if(data.status == 'success'){
                window.location.href = '<?php echo e(url('/checkout')); ?>';
            }
            
        });
    }


    function cartQuantityInitialize() {
        $('.btn-number').click(function (e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }


</script>
<?php echo $__env->yieldPushContent('js'); ?>
</body>

</html>
<?php /**PATH D:\public_html\resources\views/website/layout.blade.php ENDPATH**/ ?>