@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h4 class="page-title mt-0 d-inline">
                            Total <span class="total">{{ $campaigns->count() }}</span> Campaigns
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right">
                            <a href="{{ route('admin.campaign.create') }}" class="btn btn-blue btn-xs waves-effect waves-light float-right">
                                <i class="fas fa-plus"></i> Add New Campaign
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($campaigns as $index => $campaign)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $campaign->name }}</td>
                                    <td>{{ $campaign->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.campaign.status', ['id'=>$campaign->id]) }}" 
                                           class="btn btn-sm {{ $campaign->status ? 'btn-success' : 'btn-danger' }}">
                                            {{ $campaign->status ? 'Active' : 'Inactive' }}
                                        </a>
                                    </td>
                                    <td>{{ $campaign->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        
                                        <a href="{{ route('campaign', $campaign->slug) }}" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.campaign.edit', $campaign->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.campaign.destroy', $campaign->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this campaign?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No campaigns found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
