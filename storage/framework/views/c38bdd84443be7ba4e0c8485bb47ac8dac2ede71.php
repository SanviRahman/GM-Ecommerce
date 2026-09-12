
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title mt-0 d-inline">Total <span class="total">0</span> Colors</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right">
                                <button type="button" class="btn btn-blue btn-add btn-xs waves-effect waves-light float-right">
                                    <i class="fas fa-plus"></i> Add New Color
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Store</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="colorName">Color Name <span class="text-danger">*</span></label>
                        <input type="text" id="colorName" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="colorCode">Color Code <span class="text-danger">*</span></label>
                        <input type="color" id="colorCode" class="form-control" value="#000000">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info btn-sm waves-effect waves-light" id="submit">Save changes</button>
                    <input type="hidden" id="id">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            var token = $("input[name='_token']").val();

            var table = $("#table").DataTable({
                ajax: "<?php echo e(url('admin/color/create')); ?>",
                pageLength: 50,
                ordering: false,
                columns: [
                    {data: "id"},
                    {data: "colorName", title: "Color Name"},
                    {data: "colorCode", title: "Color Code"},
                    {data: "status", title: "Status"},
                    {data: "action", title: "Action"}
                ],
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-sm");
                },
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    var numRows = api.rows().count();
                    $('.total').empty().append(numRows);
                }
            });

            $(document).on("click", ".btn-add", function() {
                var modal = $('#modal');
                modal.find('.modal-title').text('Add New Color');
                modal.find('.modal-footer .btn-info').text('Save');
                modal.find('.modal-footer .btn-info').val('Save');
                modal.modal('show');
            });

            $(document).on("click", ".btn-edit", function() {
                var id = $(this).attr('data-id');
               
                $.ajax({
                    url: "<?php echo e(url('admin/color')); ?>/" + id + "/edit",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    contentType: 'application/json',
                    success: function(data) {
                        $('#id').val(id);
                        $('#colorName').val(data['colorName']);
                        $('#colorCode').val(data['colorCode']);

                        var modal = $('#modal');
                        modal.find('.modal-title').text('Edit Color');
                        modal.find('.modal-footer .btn-info').text('Update');
                        modal.find('.modal-footer .btn-info').val('Update');
                        modal.modal('show');
                    }
                });
            });

            $(document).on("click", "#submit", function(e) {
                var type = $(this).val();
                var colorName = $('#colorName');
                var colorCode = $('#colorCode');
                var id = $('#id').val();
                var count = 0;

                if (!colorName.val()) {
                    colorName.addClass("parsley-error");
                    toastr.error('Color Name should not be empty!');
                    count++;
                }
                if (!colorCode.val()) {
                    colorCode.addClass("parsley-error");
                    toastr.error('Color Code should not be empty!');
                    count++;
                }
                if (count > 0) {
                    return;
                }

                // Add Data
                if (type === 'Save') {
                    $.ajax({
                        type: "post",
                        url: "<?php echo e(url('admin/color')); ?>",
                        data: {
                            'colorName': colorName.val(),
                            'colorCode': colorCode.val(),
                            '_token': token
                        },
                        success: function(response) {
                            if (response['status'] === 'success') {
                                toastr.success(response["message"]);
                                $('#modal').modal('toggle');
                                table.ajax.reload();
                            } else {
                                toastr.error(response["message"]);
                            }
                        }
                    });
                    return;
                }

                // Update data
                if (type === 'Update') {
                    console.log('Update'+id);
                    $.ajax({
                        type: "PUT",
                        url: "<?php echo e(url('admin/color')); ?>/" + id,
                        data: {
                            'colorName': colorName.val(),
                            'colorCode': colorCode.val(),
                            '_token': token
                        },
                        success: function(data) {
                            if (data['status'] === 'success') {
                                toastr.success(data["message"]);
                                $('#modal').modal('toggle');
                                table.ajax.reload();
                            } else {
                                toastr.error(data["message"]);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.btn-status', function() {
                var status = $(this).attr('data-status');
                var id = $(this).val();
                $.ajax({
                    type: "post",
                    url: "<?php echo e(url('admin/color/status')); ?>",
                    data: {
                        'status': status,
                        'id': id,
                        '_token': token
                    },
                    success: function(data) {
                        if (data['status'] === 'success') {
                            toastr.success(data["message"]);
                            table.ajax.reload();
                        } else {
                            toastr.error(data["message"]);
                        }
                    }
                });
            });

            $(document).on("click", ".btn-delete", function() {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "<?php echo e(url('admin/color')); ?>" + "/" + id,
                            type: 'DELETE',
                            data: {
                                '_token': token
                            },
                            success: function(data) {
                                if (data['status'] === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        data["message"],
                                        'success'
                                    );
                                    table.ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data["message"],
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });
            });

            $(document).on("focus", "#colorName, #colorCode", function() {
                $(this).removeClass("parsley-error");
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\public_html\resources\views/admin/color/index.blade.php ENDPATH**/ ?>