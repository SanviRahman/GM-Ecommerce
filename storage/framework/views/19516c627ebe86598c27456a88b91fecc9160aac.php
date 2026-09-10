<?php $__env->startSection('content'); ?>
    <?php echo Menu::render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <?php echo Menu::scripts(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html\resources\views/admin/menu.blade.php ENDPATH**/ ?>