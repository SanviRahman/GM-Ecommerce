<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-8 col-xl-6">
        <div class="card"><div class="card-body">
            <h4 class="page-title mt-0 mb-3">Add Newsletter Subscriber</h4>
            <form method="POST" action="<?php echo e(route('admin.newsletter-subscribers.store')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('admin.newsletter-subscribers._form', ['submitLabel' => 'Add Subscriber'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </form>
        </div></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html leatherket\resources\views/admin/newsletter-subscribers/create.blade.php ENDPATH**/ ?>