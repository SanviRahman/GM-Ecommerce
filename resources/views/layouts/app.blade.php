<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <!-- App css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>


    <link href="{{asset('libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" >

    <link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/dataTables.checkboxes.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('libs/summernote/summernote-bs4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <script>
        var siteURL = "{{ url('/') }}";
       
    </script>
 
    @stack('css')
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body  data-keep-enlarged="true" class="enlarged">
{{--class="enlarged"--}}
<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    @include('layouts.topbar')
    <!-- end Topbar -->

    <!-- Left Sidebar Start -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            @if(request()->is('admin/dashboard') || request()->is('user/dashboard') || request()->is('manager/dashboard'))
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <input type="text" id="datepicker" class="form-control" value="<?php echo date('Y-m-d')?>" placeholder="2018-10-03 to 2018-10-10">
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">
                                Welcome {{Auth::user()->name}}
                            </h4>
                        </div>
                    </div>
                </div>

                @else
                    <br>

            @endif


            @yield('content')
        </div> <!-- content -->
    </div>
    <!-- Modal Structure -->
    @php
    use Illuminate\Support\Str;
@endphp

@if (Str::contains(request()->url(), 'order'))
<div class="modal fade" id="fraudCheckModal" tabindex="-1" role="dialog" aria-labelledby="fraudCheckModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fraudCheckModalLabel">Fraud Check</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- The fetched data will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Proceed</button>
            </div>
        </div>
    </div>
</div>
@endif



    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/vendor.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!-- third party js -->
    <script src="{{asset('libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('libs/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('libs/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('libs/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('libs/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{asset('libs/select2/select2.min.js')}}"></script>

    <script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/dataTables.checkboxes.min.js')}}"></script>

    <script src="{{asset('js/media.js')}}"></script>
    <script>
    // Check if there's a session message (like Laravel's flash session)
    $(document).ready(function() {
        @if(session('message'))
            Swal.fire({
                title: "Success!",
                text: "{{ session('message') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        @endif
    });
        @if(Auth::user()->role_id == 1)
        setInterval(function(){
            $.ajax({
                type : "get",
                url: "{{url('admin/dashboard/getNotification')}}",
                success : function(response){
                    var data = JSON.parse(response);
                    if(data["status"] !== 'empty'){
                        console.log(response);
                        toastr.success(data["notificaton"]);
                        console.log(response)
                    }
                }
            });
        },3000);
        @endif
        @if(Auth::user()->role_id == 2)
        setInterval(function(){
            $.ajax({
                type : "get",
                url: "{{url('manager/dashboard/getNotification')}}",
                success : function(response){
                    var data = JSON.parse(response);
                    if(data["status"] !== 'empty'){
                        console.log(response);
                        toastr.success(data["notificaton"]);
                        console.log(response)
                    }
                }
            });
        },3000);
        @endif
        

    
    function openFraudCheckModal(button) {
    const phone = $(button).data('phone');
    if (!phone) return;

    $('#phoneNumber').text(phone);
    $('.modal-body').html(`
        <p id="loadingMessage">
            Loading data for phone number: <strong>${phone}</strong>...
        </p>
    `);

    $('#fraudCheckModal').modal('show');

    fetch('/fraud-check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ phone })
    })
    .then(res => res.json())
    .then(response => {
        $('#loadingMessage').remove();

        if (response.status !== 'success' || !response.data) {
            $('.modal-body').html(`
                <p class="text-danger text-center">No data found</p>
            `);
            return;
        }

        const data = response.data;

        let html = `
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="table-light">
                        <th>Courier</th>
                        <th>Total</th>
                        <th class="text-success">Success</th>
                        <th class="text-danger">Cancelled</th>
                        <th>Success %</th>
                    </tr>
                </thead>
                <tbody>
        `;

        // Loop through object keys
        Object.keys(data).forEach(key => {
            if (key === 'summary') return;

            const c = data[key];

            html += `
                <tr>
                    <td>
                        <img src="${c.logo}" height="24" class="me-1">
                        ${c.name}
                    </td>
                    <td class="text-center">${c.total_parcel}</td>
                    <td class="text-center text-success">${c.success_parcel}</td>
                    <td class="text-center text-danger">${c.cancelled_parcel}</td>
                    <td class="text-center fw-bold">${c.success_ratio}%</td>
                </tr>
            `;
        });

        // Summary row
        if (data.summary) {
            html += `
                <tr class="table-secondary fw-bold">
                    <td>Total</td>
                    <td class="text-center">${data.summary.total_parcel}</td>
                    <td class="text-center text-success">${data.summary.success_parcel}</td>
                    <td class="text-center text-danger">${data.summary.cancelled_parcel}</td>
                    <td class="text-center">${data.summary.success_ratio}%</td>
                </tr>
            `;
        }

        html += `</tbody></table>`;

        $('.modal-body').html(html);
    })
    .catch(error => {
        console.error(error);
        $('.modal-body').html(`
            <p class="text-danger text-center">
                Failed to load fraud check data.
            </p>
        `);
    });
}





    </script>
    
 
    @stack('js')
    @livewireScripts
</body>
</html>
