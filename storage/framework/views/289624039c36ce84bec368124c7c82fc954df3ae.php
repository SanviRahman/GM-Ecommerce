<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    <h4 class="card-title mt-0 d-inline">Product Option Wise Price Variation </h4>
                    <a href="<?php echo e(url('admin/product')); ?>" class="btn btn-info btn-sm">Back</a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.product.update-option-price', $product->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="proOption" class="form-label">Options</label>
                            <select class="form-control select2" name="proOption[]" id="proOption" multiple="multiple" onchange="handleOptionChange()">
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($option->id); ?>" 
                                        <?php if($product->options->contains($option->id)): ?> selected <?php endif; ?>>
                                        <?php echo e($option->optionName); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div id="optionPrices">
                            <?php $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectedOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <div class="form-group mb-3" id="option_<?php echo e($selectedOption->id); ?>">
                                    <label for="price_<?php echo e($selectedOption->option_id); ?>" class="form-label"><?php echo e($selectedOption->optionName); ?> Price</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="optionPrices[<?php echo e($selectedOption->id); ?>]" 
                                        id="price_<?php echo e($selectedOption->id); ?>" 
                                        step="any" required 
                                        placeholder="Enter price for <?php echo e($selectedOption->optionName); ?>" 
                                        value="<?php echo e($selectedOption->pivot->price); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-3">Update Price</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
    function handleOptionChange() {
        const selectElement = document.getElementById('proOption');
        const selectedOptions = Array.from(selectElement.selectedOptions).map(opt => ({
            id: opt.value,
            name: opt.text,
        }));
    
        const container = document.getElementById('optionPrices');
    
        // Track existing fields and their prices
        const existingFields = Array.from(container.children).map(div => {
            const optionId = div.id.replace('option_', '');
            const priceInput = div.querySelector('input');
            return { id: optionId, price: priceInput ? priceInput.value : null };
        });
        
        console.log(existingFields);
        console.log(selectedOptions);
    
        // Add new fields for newly selected options
        selectedOptions.forEach(option => {
            // Check if the option is already selected and add its price input field if it's not there
            if (!existingFields.some(field => field.id === option.id)) {
                const inputGroup = `
                    <div class="form-group mb-3" id="option_${option.id}">
                        <label for="price_${option.id}" class="form-label">${option.name} Price *</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            name="optionPrices[${option.id}]"
                            value="${option.price}" 
                            id="price_${option.id}" 
                            step="any" 
                            required
                            placeholder="Enter price for ${option.name}">
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', inputGroup);
            }
        });
    
        // Remove fields for unselected options and keep prices for the selected ones
        existingFields.forEach(field => {
            if (!selectedOptions.find(opt => opt.id === field.id)) {
                const fieldToRemove = document.getElementById(`option_${field.id}`);
                if (fieldToRemove) {
                    fieldToRemove.remove();
                }
            }
        });
    
        // Reapply the prices for the selected options
        selectedOptions.forEach(option => {
            const existingField = existingFields.find(field => field.id === option.id);
            if (existingField) {
                const priceInput = document.getElementById(`price_${option.id}`);
                if (priceInput && existingField.price) {
                    priceInput.value = existingField.price;
                }
            }
        });
    }



      document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 on the select element
        $('.select2').select2({
            placeholder: 'Select Options',
            allowClear: true
        });
        
      });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html\resources\views/admin/product/option.blade.php ENDPATH**/ ?>