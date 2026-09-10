<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <?php if(Auth::check() && Auth::user()->role->id == 1): ?>
                <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li class="<?php echo e((request()->is('admin/dashboard')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e((request()->is('admin/dashboard')) ? 'active' : ''); ?>">
                        <i class="fe-airplay"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-truck"></i>
                        <span> Report </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="<?php echo e((request()->is('admin/report/multipleDateCourierUser')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/report/multipleDateCourierUser ')); ?>" class="<?php echo e((request()->is('admin/report/multipleDateCourierUser')) ? 'active' : ''); ?>">Courier User Report</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/report/dateCourier')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/report/dateCourier ')); ?>" class="<?php echo e((request()->is('admin/report/dateCourier')) ? 'active' : ''); ?>">Courier Report</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/report/dateUser')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/report/dateUser ')); ?>" class="<?php echo e((request()->is('admin/report/dateUser')) ? 'active' : ''); ?>">User Report</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/report/product')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/report/product ')); ?>" class="<?php echo e((request()->is('admin/report/product')) ? 'active' : ''); ?>">Product</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/report/payment')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/report/payment ')); ?>" class="<?php echo e((request()->is('admin/report/payment')) ? 'active' : ''); ?>">Payment</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-globe"></i>
                        <span> Website </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="<?php echo e((request()->is('admin/product')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/product ')); ?>" class="<?php echo e((request()->is('admin/product')) ? 'active' : ''); ?>">Products</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/media')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/media ')); ?>" class="<?php echo e((request()->is('admin/media')) ? 'active' : ''); ?>">Media</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/category')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/category ')); ?>" class="<?php echo e((request()->is('admin/category')) ? 'active' : ''); ?>">Category</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/option')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/option')); ?>" class="<?php echo e((request()->is('admin/option')) ? 'active' : ''); ?>">Option</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/size')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/size')); ?>" class="<?php echo e((request()->is('admin/size')) ? 'active' : ''); ?>">Size</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/color')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/color')); ?>" class="<?php echo e((request()->is('admin/color')) ? 'active' : ''); ?>">Color</a>
                        </li>
                        
                        <li class="<?php echo e((request()->is('admin/section')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/section ')); ?>" class="<?php echo e((request()->is('admin/section')) ? 'active' : ''); ?>">Section</a>
                        </li>
                        
                        <li class="<?php echo e((request()->is('admin/menu')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/menu ')); ?>" class="<?php echo e((request()->is('admin/menu')) ? 'active' : ''); ?>">Menu</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/campaign')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/campaign ')); ?>" class="<?php echo e((request()->is('admin/campaign')) ? 'active' : ''); ?>">Campaign</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/page')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/page ')); ?>" class="<?php echo e((request()->is('admin/page')) ? 'active' : ''); ?>">Page</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/slider')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/slider ')); ?>" class="<?php echo e((request()->is('admin/slider')) ? 'active' : ''); ?>">Slider</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/setting')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/setting ')); ?>" class="<?php echo e((request()->is('admin/setting')) ? 'active' : ''); ?>">Settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-package"></i>
                        <span> Store </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <li class="<?php echo e((request()->is('admin/store')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/store ')); ?>" class="<?php echo e((request()->is('admin/store')) ? 'active' : ''); ?>">Store</a>
                        </li>
                        <li >
                            <a href="<?php echo e(url('admin/purchase ')); ?>" class="<?php echo e((request()->is('admin/purchase')) ? 'active' : ''); ?>">Purchase</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/stock ')); ?>" class="<?php echo e((request()->is('admin/stock')) ? 'active' : ''); ?>">Stock</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/supplier ')); ?>" class="<?php echo e((request()->is('admin/supplier')) ? 'active' : ''); ?>">Supplier</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/payment ')); ?>" class="<?php echo e((request()->is('admin/payment')) ? 'active' : ''); ?>">Payment</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/payment/type ')); ?>" class="<?php echo e((request()->is('admin/payment/type')) ? 'active' : ''); ?>">Payment Method</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-truck"></i>
                        <span> Courier </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="<?php echo e((request()->is('admin/courier')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/courier ')); ?>" class="<?php echo e((request()->is('admin/courier')) ? 'active' : ''); ?>">Courier</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/city')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/city ')); ?>" class="<?php echo e((request()->is('admin/city')) ? 'active' : ''); ?>">City</a>
                        </li>
                        <li class="<?php echo e((request()->is('admin/zone')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('admin/zone ')); ?>" class="<?php echo e((request()->is('admin/zone')) ? 'active' : ''); ?>">Zone</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo e((request()->routeIs('admin/order')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/order/status/Incomplete ')); ?>" class="<?php echo e((request()->is('admin/order')) ? 'active' : ''); ?>">
                        <i class="fe-alert-circle"></i>
                        <span>Incomplete Order </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->routeIs('admin/order')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/order/status/Processing ')); ?>" class="<?php echo e((request()->is('admin/order')) ? 'active' : ''); ?>">
                        <i class="fe-shopping-cart"></i>
                        <span> Order </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->is('admin/order/Pending Invoiced')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/order/status/Pending Invoiced ')); ?>" class="<?php echo e((request()->is('admin/order/status/Pending Invoiced')) ? 'active' : ''); ?>">
                        <i class="fas fa-file-invoice"></i>
                        <span> Invoiced </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->is('admin/order/Delivered')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/order/status/Delivered ')); ?>" class="<?php echo e((request()->is('admin/order/status/Delivered')) ? 'active' : ''); ?>">
                        <i class="mdi mdi-truck-check"></i>
                        <span> Delivered </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->is('admin/user')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/user ')); ?>" class="<?php echo e((request()->is('admin/user')) ? 'active' : ''); ?>">
                        <i class="fas fa-user"></i>
                        <span> User </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->is('admin/ip')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/ip ')); ?>" class="<?php echo e((request()->is('admin/ip')) ? 'active' : ''); ?>">
                        <i class="fas fa-bars"></i>
                        <span> IP Manage </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->is('admin/shipping')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/shipping ')); ?>" class="<?php echo e((request()->is('admin/shipping')) ? 'active' : ''); ?>">
                        <i class="fas fa-bars"></i>
                        <span> Shipping Charge </span>
                    </a>
                </li>
                <li class="<?php echo e((request()->is('admin/optimize')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/optimize ')); ?>" class="<?php echo e((request()->is('admin/optimize')) ? 'active' : ''); ?>">
                        <i class="far fa-trash-alt"></i>
                        <span>Optimize</span>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
            <?php if(Auth::user()->role->id == 2): ?>
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Navigation</li>
                        <li class="<?php echo e((request()->is('manager/dashboard')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manager.dashboard')); ?>" class="<?php echo e((request()->is('manager/dashboard')) ? 'active' : ''); ?>">
                                <i class="fe-airplay"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fe-truck"></i>
                                <span> Report </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="<?php echo e((request()->is('manager/report/multipleDateCourierUser')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/report/multipleDateCourierUser ')); ?>" class="<?php echo e((request()->is('manager/report/multipleDateCourierUser')) ? 'active' : ''); ?>">Courier User Report</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/report/dateCourier')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/report/dateCourier ')); ?>" class="<?php echo e((request()->is('manager/report/dateCourier')) ? 'active' : ''); ?>">Courier Report</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/report/dateUser')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/report/dateUser ')); ?>" class="<?php echo e((request()->is('manager/report/dateUser')) ? 'active' : ''); ?>">User Report</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/report/product')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/report/product ')); ?>" class="<?php echo e((request()->is('manager/report/product')) ? 'active' : ''); ?>">Product</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/report/payment')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/report/payment ')); ?>" class="<?php echo e((request()->is('manager/report/payment')) ? 'active' : ''); ?>">Payment</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fe-package"></i>
                                <span> Store </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="<?php echo e((request()->is('manager/product')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/product ')); ?>" class="<?php echo e((request()->is('manager/product')) ? 'active' : ''); ?>">Products</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/category')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/category ')); ?>" class="<?php echo e((request()->is('manager/category')) ? 'active' : ''); ?>">Category</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/option')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/option')); ?>" class="<?php echo e((request()->is('manager/option')) ? 'active' : ''); ?>">Option</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/size')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/size')); ?>" class="<?php echo e((request()->is('manager/size')) ? 'active' : ''); ?>">Size</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/color')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/color')); ?>" class="<?php echo e((request()->is('manager/color')) ? 'active' : ''); ?>">Color</a>
                                </li>
                                
                                <li class="<?php echo e((request()->is('manager/section')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/section ')); ?>" class="<?php echo e((request()->is('manager/section')) ? 'active' : ''); ?>">Section</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/store')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/store ')); ?>" class="<?php echo e((request()->is('manager/store')) ? 'active' : ''); ?>">Store</a>
                                </li>
                                <li >
                                    <a href="<?php echo e(url('manager/purchase ')); ?>" class="<?php echo e((request()->is('manager/purchase')) ? 'active' : ''); ?>">Purchase</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('manager/stock ')); ?>" class="<?php echo e((request()->is('manager/stock')) ? 'active' : ''); ?>">Stock</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('manager/supplier ')); ?>" class="<?php echo e((request()->is('manager/supplier')) ? 'active' : ''); ?>">Supplier</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('manager/payment ')); ?>" class="<?php echo e((request()->is('manager/payment')) ? 'active' : ''); ?>">Payment</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('manager/payment/type ')); ?>" class="<?php echo e((request()->is('manager/payment/type')) ? 'active' : ''); ?>">Payment Method</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fe-truck"></i>
                                <span> Courier </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="<?php echo e((request()->is('manager/courier')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/courier ')); ?>" class="<?php echo e((request()->is('manager/courier')) ? 'active' : ''); ?>">Courier</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/city')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/city ')); ?>" class="<?php echo e((request()->is('manager/city')) ? 'active' : ''); ?>">City</a>
                                </li>
                                <li class="<?php echo e((request()->is('manager/zone')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('manager/zone ')); ?>" class="<?php echo e((request()->is('manager/zone')) ? 'active' : ''); ?>">Zone</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo e((request()->routeIs('manager/order')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('manager/order/status/Incomplete ')); ?>" class="<?php echo e((request()->is('manager/order')) ? 'active' : ''); ?>">
                                <i class="fe-alert-circle"></i>
                                <span>Incomplete Order </span>
                            </a>
                        </li>
                        <li class="<?php echo e((request()->routeIs('manager/order')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('manager/order/status/Processing ')); ?>" class="<?php echo e((request()->is('manager/order')) ? 'active' : ''); ?>">
                                <i class="fe-shopping-cart"></i>
                                <span> Order </span>
                            </a>
                        </li>
                        <li class="<?php echo e((request()->is('manager/order/Pending Invoiced')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('manager/order/status/Pending Invoiced ')); ?>" class="<?php echo e((request()->is('manager/order/status/Pending Invoiced')) ? 'active' : ''); ?>">
                                <i class="fas fa-file-invoice"></i>
                                <span> Invoiced </span>
                            </a>
                        </li>
                        <li class="<?php echo e((request()->is('manager/order/Delivered')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('manager/order/status/Delivered ')); ?>" class="<?php echo e((request()->is('manager/order/status/Delivered')) ? 'active' : ''); ?>">
                                <i class="mdi mdi-truck-check"></i>
                                <span> Delivered </span>
                            </a>
                        </li>
                        <li class="<?php echo e((request()->is('manager/user')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('manager/user ')); ?>" class="<?php echo e((request()->is('manager/user')) ? 'active' : ''); ?>">
                                <i class="fas fa-user"></i>
                                <span> User </span>
                            </a>
                        </li>
                        <!--<li class="<?php echo e((request()->is('manager/ip')) ? 'active' : ''); ?>">-->
                        <!--    <a href="<?php echo e(url('manager/ip ')); ?>" class="<?php echo e((request()->is('manager/ip')) ? 'active' : ''); ?>">-->
                        <!--        <i class="fas fa-bars"></i>-->
                        <!--        <span> IP Manage </span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="<?php echo e((request()->is('manager/optimize')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('manager/optimize ')); ?>" class="<?php echo e((request()->is('manager/optimize')) ? 'active' : ''); ?>">
                                <i class="far fa-trash-alt"></i>
                                <span>Optimize</span>
                            </a>
                        </li>
                     </ul>
                <?php endif; ?>
            <?php if(Auth::check() && Auth::user()->role->id == 3 ): ?>
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigation</li>
                    <li class="<?php echo e((request()->is('user/dashboard')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e((request()->is('user/dashboard')) ? 'active' : ''); ?>">
                            <i class="fe-airplay"></i>
                            <span> Dashboards </span>
                        </a>
                    </li>
                    <li class="<?php echo e((request()->routeIs('user/order')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('user/order/status/Incomplete ')); ?>" class="<?php echo e((request()->is('user/order')) ? 'active' : ''); ?>">
                            <i class="fe-alert-circle"></i>
                            <span>Incomplete Order </span>
                        </a>
                    </li>
                    <li class="<?php echo e((request()->routeIs('user/order')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('user/order/status/Processing')); ?>" class="<?php echo e((request()->is('user/order')) ? 'active' : ''); ?>">
                            <i class="fe-shopping-cart"></i>
                            <span> Order </span>
                        </a>
                    </li>
                    <li class="<?php echo e((request()->is('user/order/Pending Invoiced')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('user/order/status/Pending Invoiced')); ?>" class="<?php echo e((request()->is('user/order/status/Pending Invoiced')) ? 'active' : ''); ?>">
                            <i class="fas fa-file-invoice"></i>
                            <span> Invoiced </span>
                        </a>
                    </li>
                    <li class="<?php echo e((request()->is('user/order/Delivered')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('user/order/status/Delivered')); ?>" class="<?php echo e((request()->is('user/order/status/Delivered')) ? 'active' : ''); ?>">
                            <i class="mdi mdi-truck-check"></i>
                            <span> Delivered </span>
                        </a>
                    </li>
                    <li class="<?php echo e((request()->is('user/order/complain')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('user/order/complain')); ?>" class="<?php echo e((request()->is('user/order/complain')) ? 'active' : ''); ?>">
                            <i class="fas fa-bullhorn"></i>
                            <span> Complain </span>
                        </a>
                    </li>
                   
                </ul>
            <?php endif; ?>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<?php /**PATH D:\public_html\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>