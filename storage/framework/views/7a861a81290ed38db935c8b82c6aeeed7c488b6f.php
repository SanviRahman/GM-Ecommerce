
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="d-none d-sm-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li>
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?php echo e(asset('images/users/user-1.jpg')); ?>" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    <?php echo e(Auth::user()->name); ?> <i class="mdi mdi-chevron-down"></i>
                </span>
                <input type="hidden" id="user_id" value="<?php echo e(Auth::id()); ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>
                <?php if(Auth::id()  === 1): ?>
                <!-- item-->
                <a href="<?php echo e(url('admin/user')); ?>" class="dropdown-item notify-item">
                    <i class="fe-settings"></i>
                    <span>Settings</span>
                </a>
                <?php endif; ?>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Lock Screen</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->

                <a href="javascript:void(0);" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span> <?php echo e(__('Logout')); ?></span>

                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="<?php echo e(url('/')); ?>" class="logo text-center">
            <span class="logo-lg">
                <span class="logo-lg-text-light"> <?php echo e(config('app.name', 'Inventory')); ?></span>
            </span>
            <span class="logo-sm">
                <span class="logo-lg-text-light">Menu</span>
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
             <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </li>
    </ul>
    <div class="clearfix"></div>

 </div>
<?php /**PATH D:\public_html\resources\views/layouts/topbar.blade.php ENDPATH**/ ?>