<div class="tile">
    <form action="<?php echo e(url('admin/setting')); ?>" method="POST" role="form">
        <?php echo csrf_field(); ?>
        <h3 class="tile-title">General Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">Site Name</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter site name"
                    id="site_name"
                    name="site_name"
                    value="<?php echo e(Settings::get('site_name')); ?>"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">Site Title</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter site title"
                    id="site_title"
                    name="site_title"
                    value="<?php echo e(Settings::get('site_title')); ?>"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="phone_number">Phone Number</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter store default phone"
                    id="phone_number"
                    name="phone_number"
                    value="<?php echo e(Settings::get('phone_number')); ?>"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="whatsapp_number">Whatsapp Number</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter store default phone"
                    id="whatsapp_number"
                    name="whatsapp_number"
                    value="<?php echo e(Settings::get('whatsapp_number')); ?>"
                />
            </div>
            <div class="form-group"><label>WhatsApp Button on Product Page</label>
                <select class="form-control" name="lk_whatsapp_button_enabled">
                    <option value="0" <?php echo e(Settings::get('lk_whatsapp_button_enabled') !== '1' ? 'selected' : ''); ?>>Off</option>
                    <option value="1" <?php echo e(Settings::get('lk_whatsapp_button_enabled') === '1' ? 'selected' : ''); ?>>On</option>
                </select>
            </div>
            <div class="form-group"><label>Call Button on Product Page</label>
                <select class="form-control" name="lk_call_button_enabled">
                    <option value="0" <?php echo e(Settings::get('lk_call_button_enabled') !== '1' ? 'selected' : ''); ?>>Off</option>
                    <option value="1" <?php echo e(Settings::get('lk_call_button_enabled') === '1' ? 'selected' : ''); ?>>On</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="home_page_all_products">Home Page All Products</label>
                <select class="form-control" name="home_page_all_products" id="home_page_all_products">
                    <option value="show" <?php if(Settings::get('home_page_all_products') == 'show'): ?>selected <?php endif; ?>>Show</option>
                    <option value="hide" <?php if(Settings::get('home_page_all_products') == 'hide'): ?>selected <?php endif; ?>>Hide</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="order_blocking_hour">
                    Order Blocking Time (Hour) <small>(0 = Off)</small>
                </label>
                <input
                    class="form-control"
                    type="number"
                    step="any"
                    min="0"
                    placeholder="Example: 1.5 = 90 min"
                    id="order_blocking_hour"
                    name="order_blocking_hour"
                    value="<?php echo e(Settings::get('order_blocking_hour')); ?>"
                />
                <small class="text-muted">
                    Examples: 1.5 = 90 minutes, 24 = 1 day, 50 = 2 days 2 hours
                </small>
            </div>
            <div class="form-group">
                <label class="control-label" for="sms_content">Sms Content</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Sms Content"
                    id="sms_content"
                    name="sms_content"
                    value="<?php echo e(Settings::get('sms_content')); ?>"
                />
            </div>
            <?php if(Auth::check() && Auth::user()->role->id == 1): ?>
                <!--<div class="form-group">-->
                <!--    <label class="control-label" for="sms_username">Sms Username</label>-->
                <!--    <input-->
                <!--        class="form-control"-->
                <!--        type="text"-->
                <!--        placeholder="Enter Sms Username"-->
                <!--        id="sms_username"-->
                <!--        name="sms_username"-->
                <!--        value="<?php echo e(Settings::get('sms_username')); ?>"-->
                <!--    />-->
                <!--</div>-->
                <!--<div class="form-group">-->
                <!--    <label class="control-label" for="sms_password">Sms Password</label>-->
                <!--    <input-->
                <!--            class="form-control"-->
                <!--            type="text"-->
                <!--            placeholder="Enter Sms Password"-->
                <!--            id="sms_password"-->
                <!--            name="sms_password"-->
                <!--            value="<?php echo e(Settings::get('sms_password')); ?>"-->
                <!--    />-->
                <!--</div>-->
            <?php endif; ?>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php /**PATH D:\public_html leatherket\resources\views/admin/settings/includes/general.blade.php ENDPATH**/ ?>