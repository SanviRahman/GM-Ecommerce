@extends('layouts.app')
@section('content')
<div class="row"><div class="col-12"><div class="card"><div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h4 class="page-title mb-2">Total <span class="total">0</span> Product Stock</h4>
        <a href="{{ route('admin.purchase.index') }}" class="btn btn-blue btn-sm mb-2"><i class="mdi mdi-plus-circle mr-1"></i>Add New Purchase</a>
    </div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="table-responsive"><table id="stockTable" class="table table-centered table-hover" width="100%">
        <thead class="thead-light"><tr><th>ID</th><th>Product Name</th><th>In a Stock</th><th>Available Stock</th><th>Actions</th></tr></thead>
    </table></div>
</div></div></div></div>

<div class="modal fade" id="lkStockEditModal" tabindex="-1" role="dialog" aria-labelledby="lkStockEditTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content">
        <form id="lkStockEditForm" method="POST" action="">
            @csrf @method('PUT')
            <div class="modal-header"><h5 id="lkStockEditTitle" class="modal-title">Adjust Available Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                <p class="mb-3">Product: <strong id="lkStockProductLabel"></strong><br>
                Current Available: <strong id="lkStockCurrent"></strong></p>
                <div class="form-group"><label for="lkStockOperation">Adjustment</label>
                    <select class="form-control" id="lkStockOperation" name="operation" required>
                        <option value="add">Add quantity (+)</option>
                        <option value="subtract">Subtract quantity (-)</option>
                        <option value="set">Set available quantity (=)</option>
                    </select></div>
                <div class="form-group"><label for="lkStockQuantity">Quantity</label>
                    <input id="lkStockQuantity" class="form-control" type="number" min="0" max="1000000" step="1" value="1" name="quantity" required></div>
                <p class="text-muted small mb-0">Purchase history (In a Stock) remains unchanged. Subtract cannot make available stock negative.</p>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Stock</button></div>
        </form>
    </div></div>
</div>
@endsection
@push('js')
<script>
$(function () {
    var token = @json(csrf_token());
    var stockBase = @json(url('admin/stock'));
    var table = $('#stockTable').DataTable({
        ajax: @json(url('admin/stock/show')),
        pageLength: 50,
        ordering: false,
        columns: [
            {data: 'id'}, {data: 'productName', render: $.fn.dataTable.render.text()}, {data: 'purchase'}, {data: 'stock'},
            {data: null, searchable: false, render: function () {
                return '<button type="button" class="btn btn-primary btn-sm mr-1 lk-stock-edit">Edit</button>' +
                    '<button type="button" class="btn btn-danger btn-sm lk-stock-delete">Delete</button>';
            }}
        ],
        initComplete: function () { $('.total').text(this.api().rows().count()); }
    });
    $('#stockTable').on('click', '.lk-stock-edit', function () {
        var row = table.row($(this).closest('tr')).data();
        if (!row) return;
        $('#lkStockEditForm').attr('action', stockBase + '/' + encodeURIComponent(row.id));
        $('#lkStockProductLabel').text(row.productName);
        $('#lkStockCurrent').text(row.stock);
        $('#lkStockOperation').val('add');
        $('#lkStockQuantity').val('1');
        $('#lkStockEditModal').modal('show');
    });
    $('#stockTable').on('click', '.lk-stock-delete', function () {
        var row = table.row($(this).closest('tr')).data();
        if (!row || !window.confirm('Delete unused stock record for ' + row.productName + '? This is allowed only without history or quantity.')) return;
        $.ajax({
            url: stockBase + '/' + encodeURIComponent(row.id), type: 'POST',
            data: {_token: token, _method: 'DELETE'},
            success: function (response) { alert(response.message); table.ajax.reload(null, false); },
            error: function (xhr) { alert((xhr.responseJSON && xhr.responseJSON.message) || 'Unable to delete stock.'); }
        });
    });
});
</script>
@endpush
