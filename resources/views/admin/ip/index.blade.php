@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title mt-0 d-inline">Total <span class="total">0</span> IP Blocked </h4>
                        </div>
                    
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Ip::all() as $ip)
                                <tr>
                                    <td>{{$ip->ip_address}}</td>
                                    <td>
                                        
                                        <form id="unblock-ip-form" action="{{ route('admin.ip.unblock') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" name="ip_address" id="unblock-ip" value="{{ $ip->ip_address }}" class="form-control d-none" placeholder="Enter IP address to unblock" readonly required>
                                            <button type="submit" class="btn btn-success">Unblock IP</button>
                                        </form>
                                        
                                     
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('js')
    
@endpush

