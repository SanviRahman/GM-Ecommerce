@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-6">
        <div class="card"><div class="card-body">
            <h4 class="page-title mt-0 mb-3">Edit Newsletter Subscriber #{{ $subscriber->id }}</h4>
            <form method="POST" action="{{ route('admin.newsletter-subscribers.update', $subscriber->id) }}">
                @csrf
                @method('PUT')
                @include('admin.newsletter-subscribers._form', ['submitLabel' => 'Update Subscriber'])
            </form>
        </div></div>
    </div>
</div>
@endsection
