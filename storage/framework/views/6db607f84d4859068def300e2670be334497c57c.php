<div class="form-group">
    <label for="newsletter-email">Subscriber Email <span class="text-danger">*</span></label>
    <input id="newsletter-email" type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('email', isset($subscriber) ? $subscriber->email : '')); ?>"
           required maxlength="254" autocomplete="email" autofocus>
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback" role="alert"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <small class="form-text text-muted">Only valid, unique email addresses are accepted.</small>
</div>
<div class="d-flex align-items-center">
    <button type="submit" class="btn btn-primary mr-2"><?php echo e($submitLabel); ?></button>
    <a href="<?php echo e(route('admin.newsletter-subscribers.index')); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH D:\public_html leatherket\resources\views/admin/newsletter-subscribers/_form.blade.php ENDPATH**/ ?>