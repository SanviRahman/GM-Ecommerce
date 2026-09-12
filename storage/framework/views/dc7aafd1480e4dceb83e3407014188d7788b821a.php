

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h4 class="page-title mt-0 d-inline">
                            Total <span class="total"><?php echo e($campaigns->count()); ?></span> Campaigns
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right">
                            <a href="<?php echo e(route('admin.campaign.create')); ?>" class="btn btn-blue btn-xs waves-effect waves-light float-right">
                                <i class="fas fa-plus"></i> Add New Campaign
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($campaign->name); ?></td>
                                    <td><?php echo e($campaign->slug); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.campaign.status', ['id'=>$campaign->id])); ?>" 
                                           class="btn btn-sm <?php echo e($campaign->status ? 'btn-success' : 'btn-danger'); ?>">
                                            <?php echo e($campaign->status ? 'Active' : 'Inactive'); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($campaign->created_at->format('d-m-Y')); ?></td>
                                    <td>
                                        
                                        <a href="<?php echo e(route('campaign', $campaign->slug)); ?>" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="<?php echo e(route('admin.campaign.edit', $campaign->id)); ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.campaign.destroy', $campaign->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this campaign?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center">No campaigns found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html\resources\views/admin/campaign/index.blade.php ENDPATH**/ ?>