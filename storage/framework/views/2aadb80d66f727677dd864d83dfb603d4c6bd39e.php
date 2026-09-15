<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipping-charges-component')->html();
} elseif ($_instance->childHasBeenRendered('cFhAUha')) {
    $componentId = $_instance->getRenderedChildComponentId('cFhAUha');
    $componentTag = $_instance->getRenderedChildComponentTagName('cFhAUha');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('cFhAUha');
} else {
    $response = \Livewire\Livewire::mount('shipping-charges-component');
    $html = $response->html();
    $_instance->logRenderedChild('cFhAUha', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html\resources\views/admin/shipping_charges/index.blade.php ENDPATH**/ ?>