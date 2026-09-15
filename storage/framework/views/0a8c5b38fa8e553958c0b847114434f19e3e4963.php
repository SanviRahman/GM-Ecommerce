<div>
    <h1>Shipping Charges</h1>

    <?php if(session()->has('message')): ?>
        <div style="color: green;">
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?>

    <form wire:submit.prevent="save">
        <div class="row gy-2">
            <div class="form-group col-md-6">
                <input type="text" wire:model="name" placeholder="Shiping Name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
               <input type="number" wire:model="charge" placeholder="Charge" class="form-control" step="0.01" required> 
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <h2>Shipping Charges List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Region</th>
                <th>Charge</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $shippingCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shippingCharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($shippingCharge->name); ?></td>
                    <td><?php echo e(number_format($shippingCharge->charge, 2)); ?></td>
                    <td>
                        <button wire:click="edit(<?php echo e($shippingCharge->id); ?>)" class="btn btn-sm btn-info">Edit</button>
                        <button wire:click="delete(<?php echo e($shippingCharge->id); ?>)" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH D:\public_html\resources\views/livewire/shipping-charges-component.blade.php ENDPATH**/ ?>