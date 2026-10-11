<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <div>
                        <h4 class="page-title mt-0">Newsletter Subscribers</h4>
                        <p class="text-muted mb-0">Total subscribers: <?php echo e(number_format($totalSubscribers)); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.newsletter-subscribers.create')); ?>" class="btn btn-blue mt-2 mt-sm-0">
                        <i class="mdi mdi-plus-circle mr-1" aria-hidden="true"></i> Add Subscriber
                    </a>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success" role="status"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <form method="GET" action="<?php echo e(route('admin.newsletter-subscribers.index')); ?>" class="form-inline mb-3">
                    <label class="sr-only" for="subscriber-search">Search subscriber email</label>
                    <input id="subscriber-search" name="search" type="search" class="form-control mr-2 mb-2" placeholder="Search by email" value="<?php echo e($search); ?>" maxlength="254">
                    <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
                    <?php if($search !== ''): ?>
                        <a href="<?php echo e(route('admin.newsletter-subscribers.index')); ?>" class="btn btn-light mb-2">Clear</a>
                    <?php endif; ?>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subscribed At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($subscriber->id); ?></td>
                                <td><?php echo e($subscriber->email); ?></td>
                                <td><?php echo e($subscriber->created_at ? $subscriber->created_at->format('d M Y, h:i A') : 'N/A'); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="<?php echo e(route('admin.newsletter-subscribers.edit', $subscriber->id)); ?>" class="btn btn-sm btn-info mr-2">Edit</a>
                                        <form action="<?php echo e(route('admin.newsletter-subscribers.destroy', $subscriber->id)); ?>" method="POST" onsubmit="return confirm('Delete this newsletter subscriber?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No newsletter subscribers found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between flex-wrap align-items-center mt-3">
                    <small class="text-muted">Showing <?php echo e($subscribers->firstItem() ?: 0); ?>–<?php echo e($subscribers->lastItem() ?: 0); ?> of <?php echo e($subscribers->total()); ?> results</small>
                    <?php echo e($subscribers->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html leatherket\resources\views/admin/newsletter-subscribers/index.blade.php ENDPATH**/ ?>