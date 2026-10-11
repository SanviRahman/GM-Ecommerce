@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-6">
        <div class="card"><div class="card-body">
            <h4 class="page-title mt-0 mb-3">Add Newsletter Subscriber</h4>
            <form method="POST" action="{{ route('admin.newsletter-subscribers.store') }}">
                @csrf
                @include('admin.newsletter-subscribers._form', ['submitLabel' => 'Add Subscriber'])
            </form>
        </div></div>
    </div>
</div>
@endsection
