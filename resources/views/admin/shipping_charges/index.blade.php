@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @livewire('shipping-charges-component')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush

