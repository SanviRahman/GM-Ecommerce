@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title mt-0 d-inline">Total <span class="total">0</span> Sizes</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right">
                                <button type="button" class="btn btn-blue btn-add btn-xs waves-effect waves-light float-right">
                                    <i class="fas fa-plus"></i> Add New Size
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Size Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Store Size</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="sizeName">Size Name <span class="text-danger">*</span></label>
                        <input type="text" id="sizeName" class="form-control" required>
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var token = $("input[name='_token']").val();

            var table = $("#table").DataTable({
                ajax: "{{ url('admin/size/create') }}",
                pageLength: 50,
                ordering: false,
                columns: [
                    { data: "id" },
                    { data: "sizeName", title: "Size Name" },
                    { data: "status", title: "Status" },
                    { data: "action", title: "Action" }
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
                $('#modal').find('.modal-title').text('Add New Size');
                $('#modal').find('.modal-footer .btn-info').text('Save');
                $('#modal').find('.modal-footer .btn-info').val('Save');
                $('#modal').modal('show');
                $('#sizeName').val('');
                $('#id').val('');
            });

            $(document).on("click", ".btn-edit", function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ url('admin/size') }}/" + id + "/edit",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(data) {
                        $('#id').val(id);
                        $('#sizeName').val(data['sizeName']);
                        $('#modal').find('.modal-title').text('Edit Size');
                        $('#modal').find('.modal-footer .btn-info').text('Update');
                        $('#modal').find('.modal-footer .btn-info').val('Update');
                        $('#modal').modal('show');
                    }
                });
            });

            $(document).on("click", "#submit", function() {
                var type = $('#modal').find('.modal-footer .btn-info').val(); // Get the value from the button
                var sizeName = $('#sizeName').val();
                var id = $('#id').val();
                var count = 0;

                if (!sizeName) {
                    $('#sizeName').addClass("parsley-error");
                    toastr.error('Size Name should not be empty!');
                    count++;
                }

                if (count > 0) {
                    return;
                }

                // Check if we're adding or updating
                if (type === 'Save') {
                    // Add Data
                    $.ajax({
                        type: "post",
                        url: "{{ url('admin/size') }}",
                        data: {
                            'sizeName': sizeName,
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
                } else if (type === 'Update') {
                    // Update Data
                    $.ajax({
                        type: "PUT",
                        url: "{{ url('admin/size') }}/" + id,
                        data: {
                            'sizeName': sizeName,
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
                    url: "{{ url('admin/size/status') }}",
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
                        console.log("{{ url('admin/size') }}"+id);
                        $.ajax({
                            url: "{{ url('admin/size') }}/" + id,
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

            $(document).on("focus", "#sizeName", function() {
                $(this).removeClass("parsley-error");
            });
        });
    </script>
@endpush
