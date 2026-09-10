@extends('layouts.app')
@push('css')
  <!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12"><livewire:create-pathao-parcel :orderId="$order_id" /> </div>
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
</script>
@endpush

