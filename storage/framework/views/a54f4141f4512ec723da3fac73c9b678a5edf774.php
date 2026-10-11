<div class="tile">
     <form action="<?php echo e(url('/admin/setting/')); ?>" method="post" role="form">
        <?php echo csrf_field(); ?>
        <div class="tile-body">
            <div class="row mt-4">
                <div class="col-3">

                    <div class="form-group mb-3">
                        <label for="productCategory">Slider Bottom Images <span class="text-danger">*</span></label>
                        <select class="form-control" id="home_slider_bottom" name="home_slider_bottom[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            <option>Select</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ProductDetails">Site Logo <span class="text-danger">*</span></label>
                        <button type="button" class="image-picker btn btn-success d-block mb-2" data-input-name="files[additional_images][]">
                            <i class="mdi mdi-cloud-upload"></i> Browse
                        </button>
                        <div class="single-image image-holder-wrapper clearfix">
                            <?php if(Settings::get('site_logo') != null): ?>
                                <div class="image-holder image-99"><img src="<?php echo e(\App\Support\PublicMedia::url(''.Settings::get('site_logo'))); ?>" class='img-fluid avatar-xl rounded'><button type="button" class="btn btn-danger btn-xs waves-effect waves-light remove-image float-right"><i class="mdi mdi-close"></i></button><input type="hidden" name="site_logo" value="<?php echo e(Settings::get('site_logo')); ?>"></div>
                            <?php else: ?>
                                <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" id="logoImg" style="width: 80px; height: auto;">

                                <div class="image-holder placeholder">
                                    <i class="mdi mdi-folder-image"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
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
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function(){
            $("#home_slider_bottom").select2({
                placeholder: "Select a Slider",
                multiple:true,
                ajax: {
                    type: "post",
                    url:'<?php echo e(url('admin/setting/getSlider')); ?>',
                    data: {
                        '_token': "<?php echo e(csrf_token()); ?>"
                    },
                    processResults: function (data) {
                        return {
                            results: $.parseJSON(data)
                        };
                    }
                }
            });

            loadFile = function(event, id) {
                var output = document.getElementById(id);
                output.src = URL.createObjectURL(event.target.files[0]);
            };
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\public_html leatherket\resources\views/admin/settings/includes/logo.blade.php ENDPATH**/ ?>