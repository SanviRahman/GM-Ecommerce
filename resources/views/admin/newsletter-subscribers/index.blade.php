@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <div>
                        <h4 class="page-title mt-0">Newsletter Subscribers</h4>
                        <p class="text-muted mb-0">Total subscribers: {{ number_format($totalSubscribers) }}</p>
                    </div>
                    <a href="{{ route('admin.newsletter-subscribers.create') }}" class="btn btn-blue mt-2 mt-sm-0">
                        <i class="mdi mdi-plus-circle mr-1" aria-hidden="true"></i> Add Subscriber
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" role="status">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('admin.newsletter-subscribers.index') }}" class="form-inline mb-3">
                    <label class="sr-only" for="subscriber-search">Search subscriber email</label>
                    <input id="subscriber-search" name="search" type="search" class="form-control mr-2 mb-2" placeholder="Search by email" value="{{ $search }}" maxlength="254">
                    <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
                    @if($search !== '')
                        <a href="{{ route('admin.newsletter-subscribers.index') }}" class="btn btn-light mb-2">Clear</a>
                    @endif
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subscribed At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->id }}</td>
                                <td>{{ $subscriber->email }}</td>
                                <td>{{ $subscriber->created_at ? $subscriber->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('admin.newsletter-subscribers.edit', $subscriber->id) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                        <form action="{{ route('admin.newsletter-subscribers.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('Delete this newsletter subscriber?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No newsletter subscribers found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between flex-wrap align-items-center mt-3">
                    <small class="text-muted">Showing {{ $subscribers->firstItem() ?: 0 }}–{{ $subscribers->lastItem() ?: 0 }} of {{ $subscribers->total() }} results</small>
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
