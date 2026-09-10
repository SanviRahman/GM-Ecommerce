@extends('layouts.app')
@push('css')
   <title>Trashed Orders</title>
  <!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
             <h1>Trashed Orders</h1> <a href="/admin/order" class="btn btn-info btn-xs">All Orders</a>
             <a href="#" class="btn btn-danger btn-xs" id="empty-trash-btn">Empty Trash</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Recipient Name</th>
                        <th>Recipient Phone</th>
                        <th>Item Quantity</th>
                        <th>Amount to Collect</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashedOrders as $order)
                    @php 
                    
                    $customer = App\Customer::withTrashed()->where('order_id', $order->id)->first();
                    $products = App\OrderProducts::withTrashed()->where('order_id', $order->id)->get();
                    @endphp
                    
                        <tr>
                            <td>{{ $order->invoiceID }}</td>
                            <td>{{ $customer->customerName??'' }}<br>{{$customer->customerAddress??''}}</td>
                            <td>{{ $customer->customerPhone??'' }}</td>
                            <td>{{ $products->sum('quantity')??'Unknown' }}</td>
                            <td>{{ $order->subTotal??'Unknown' }}</td>
                            <td>{{ $order->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.orders.restore', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-xs">Restore</button>
                                </form>
                                <form action="{{ route('admin.orders.forceDelete', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize select2 for all select elements with class 'select2'
        $('.select2').select2();

        // Reinitialize select2 after every Livewire update
        Livewire.hook('message.processed', (message, component) => {
            $('.select2').select2();
        });
    });
    document.getElementById('empty-trash-btn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action of the button

        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete all items in the trash!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                // If confirmed, proceed with the action
                window.location.href = "{{ route('admin.emptyTrash') }}";
            }
        });
    });
</script>
@endpush