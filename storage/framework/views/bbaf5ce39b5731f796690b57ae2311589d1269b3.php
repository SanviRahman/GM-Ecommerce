<div class="tile">
    <form action="<?php echo e(url('/admin/setting/')); ?>" method="POST" role="form">
        <?php echo csrf_field(); ?>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="product_bottom_text">Product Bottom text</label>
                <textarea
                    class="form-control"
                    rows="8"
                    cols="8"
                    placeholder="Enter Product Bottom text"
                    id="product_bottom_text"
                    name="product_bottom_text"
                ><?php echo e(Settings::get('product_bottom_text')); ?></textarea>
            </div>
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
<?php /**PATH D:\public_html leatherket\resources\views/admin/settings/includes/product.blade.php ENDPATH**/ ?>