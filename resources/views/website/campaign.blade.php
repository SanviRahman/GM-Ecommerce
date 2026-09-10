<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

    <title>{{ Settings::get('site_name') }}</title>

    <script src="{{asset('assets/js/jquery-2.0.0.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/fonts/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/ui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css"  media="only screen and (max-width: 1200px)"  />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100..800&family=Bebas+Neue&display=swap');
        *{
             font-family: "Anek Bangla", sans-serif;
        }
    </style>
    @stack('css')
    {!! Settings::get('facebook_pixels') !!}
    
    <style>
        
        /* Style for selected product card */
        .selected {
            border: 2px solid green; /* Change border color to green */
        }
        .countdown-container {
            text-align: center;
        }
        .counter-card {
            border: 2px dotted white; /* Dotted border */
            border-radius: 15px; /* Rounded corners */
            padding: 5px; /* Padding for the card */
            background-color: transparent; /* Slightly transparent white background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            text-align: center; /* Center the text within each card */
           
        }
        .counter-card div{
            font-size: 1.2em;
            font-weight:bolder;
            color:white;
        }
        
        
        .counter-card span {
            display: block; /* Make the span block-level for better spacing */
            font-size: 0.8em; /* Font size for labels */
            color:orange;
        }
    
        
       
        .form_inn{
            padding:10px;
        }
        @media (max-width: 992px) {
            .campro_inn,.cont_inner,.cont_num ,.discount_inn{
                padding: 10px!important; /* Add 10px padding for tablet and smaller devices */
                width: 100%;
            }
            .discount_inn{
                margin:10px 0 0 0;
            }
            .campro_inn h2{
                font-size:20px;
            }
        }

    </style>
    <style>
        .button-3d {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    
       
        
    
        .button-3d:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
    
       
    
    </style>
    <style>
        .button-animated-border {
            position: relative;
            overflow: hidden;
            border: 3px solid white; /* Initial border */
            border-radius: 10px; /* Optional: for rounded corners */
            transition: color 0.3s ease; /* Transition for text color */
            animation: border-animation 3s linear infinite; /* Animation */
        }
    
        
    
        @keyframes border-animation {
            0% {
                border-color: white; /* Transparent at start */
                transform: scale(0.95); /* Initial scale */
            }
            25% {
                border-color: yellow; /* Fill with white */
                transform: scale(1); /* Slightly grow */
            }
            50% {
                border-color: white; /* Transparent in middle */
                transform: scale(0.95); /* Back to original scale */
            }
            75% {
                border-color: yellow; /* Fill with white again */
                transform: scale(1); /* Slightly grow again */
            }
            100% {
                border-color: white; /* Transparent at end */
                transform: scale(0.95); /* Back to original scale */
            }
        }
    
        .button-animated-border:hover {
            color: #fff; /* Change text color on hover */
        }
    </style>
    <style>
        .price-regular {
            font-size: 24px;
            color: #f44336;
            position: relative;
            display: inline-block;
            font-weight: bold;
        }
    
        .price-regular::before,
        .price-regular::after {
            content: "";
            position: absolute;
            height: 2px;
            background: red;
            width: 100%;
            top: 40%;
            left: 0;
            transform: rotate(-10deg);
        }
    
        .price-regular::after {
            top: 60%;
            transform: rotate(10deg);
        }
    
        .price-sale {
            font-size: 28px;
            font-weight: bold;
            color: #FDDF31;
            animation: pulse 1.2s infinite;
        }
    
        @keyframes pulse {
            0% {
                text-shadow: 0 0 0px #00e676;
            }
            50% {
                text-shadow: 0 0 8px #00e676;
            }
            100% {
                text-shadow: 0 0 0px #00e676;
            }
        }
        .price-sale-animated {
            margin-left:20px;
            font-size: 28px;
            font-weight: bold;
            color: #FDDF31;
            background-color: #1b1b1b;
            padding: 8px 16px;
            border-radius: 50px;
            border: 2px solid #FDDF31;
            position: relative;
            animation: glow-border 1.5s infinite alternate;
            display: inline-block;
        }
    
        @keyframes glow-border {
            0% {
                box-shadow: 0 0 5px #00e676, 0 0 10px #00e676;
            }
            100% {
                box-shadow: 0 0 15px #00e676, 0 0 25px #00e676;
            }
        }
        
    </style>
    <style>
    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 10px rgba(233, 30, 99, 0.6);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(233, 30, 99, 1);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 10px rgba(233, 30, 99, 0.6);
        }
    }
    </style>
</head>

<body>
<section style="background-image: radial-gradient(at center center, #171515 28%, #171515 79%)">
    <div class="container py-3 py-md-5">
        
        <div class="row gy-2 justify-content-between align-items-center">
            <div class="col-md-6 text-start">
                <h2 class=" py-2 py-md-4 fw-bolder" style="color:#FDDF31">{!! $campaign_data->banner_title  !!} </h2>
                <h5 class="text-light fs-4 font-weight-normal">{!! $campaign_data->short_description !!}</h5>
                <h4 class="text-light mt-3 text-center">
                    রেগুলার মূল্য <span class="price-regular"> ৳ {{$campaign_data->product->productRegularPrice}} টাকা </span>
                </h4>
                <h4 class="text-light mt-3 text-center">
                    অফার মূল্য <span class="price-sale price-sale-animated"> ৳ {{$campaign_data->product->productSalePrice}} টাকা </span>
                </h4>
                <div style="text-align: center; margin: 40px 0;">
                    <a href="#order_form" style="
                        display: inline-block;
                        font-size: 24px;
                        font-weight: bold;
                        color: white;
                        background: linear-gradient(to right, #FF5722, #E91E63);
                        padding: 16px 40px;
                        border: none;
                        border-radius: 50px;
                        text-decoration: none;
                        box-shadow: 0 0 10px rgba(233, 30, 99, 0.6);
                        animation: pulse 1.5s infinite;
                        transition: transform 0.3s ease;
                    ">
                         অর্ডার করতে ক্লিক করুন 
                    </a>
                </div>

            </div>
             <div class="col-md-6">
                <img class="img-fluid shadow border rounded" src="{{asset('public/campaigns/'.$campaign_data->banner)}}" >
            </div>
        </div>
    </div>
</section>
   
@if($campaign_data->video!=null)
<section class="camp_video_sec">
    <div class="container">
    
        <div class="row justify-content-center gy-2 gy-md-4">
            <div class="col-md-8">
                <h2 class="p-2 py-md-3 rounded text-center" style="background-color:black;border:green 2px solid;color:white;font-weight:bolder">প্রডাক্টের "ভিডিও দেখুন"</h2>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="camp_vid rounded" style="border:5px solid red">
                    <iframe width="100%" height="480" 
                    src="https://www.youtube.com/embed/{{$campaign_data->video}}" 
                    title="{{$campaign_data->banner_title}}" Recipe"" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>
                </div>
            </div>
            <div class="col-sm-12">
                <div style="text-align: center; margin: 40px 0;">
                    <a href="#order_form" style="
                        display: inline-block;
                        font-size: 24px;
                        font-weight: bold;
                        color: white;
                        background: linear-gradient(to right, #FF5722, #E91E63);
                        padding: 16px 40px;
                        border: none;
                        border-radius: 50px;
                        text-decoration: none;
                        box-shadow: 0 0 10px rgba(233, 30, 99, 0.6);
                        animation: pulse 1.5s infinite;
                        transition: transform 0.3s ease;
                    ">
                         অর্ডার করতে ক্লিক করুন 
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section class="py-2 py-md-4" style="background: linear-gradient(to bottom, #FAF4B3, #ECC7CF);">
    <div class="container my-2 my-md-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <h2 class="text-center p-2 p-md-4 rounded" style="background-color:#FBEFF7; border:2px dashed #F1ACE7;">
                    আমাদের থেকে বিস্তারিত জানতে এই 
                    <a href="tel:{{ Settings::get('phone_number') }}" style="color:#d63384; font-weight: bold; text-decoration: underline;">
                        {{ Settings::get('phone_number') }}
                    </a> 
                    নাম্বারে কল করুন 
                    
                </h2>

                <div class="row justify-content-center my-2 my-md-4 gy-2">
                    <div class="col-md-6 custom_btn">
                        <div class="shadow-lg">
                            <a href="tel:{{ Settings::get('phone_number') }}" 
                            class="btn btn-danger btn-lg d-block py-md-3 fs-2 fw-bolder button-3d button-animated-border" >
                                 আমাদের কল করুন <i class="fas fa-phone"></i></a>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                    <div class="shadow-lg">
                        <a href="https://wa.me/{{ Settings::get('whatsapp_number') }}" 
                        class="btn btn-success btn-lg d-block py-md-3 fs-2 text-light fw-bolder button-3d button-animated-border">
                            <i class="fab fa-whatsapp"></i> হোয়াটসঅ্যাপ  
                            </a>
                     </div>
                        
                    </div>
                </div>
                <div style="text-align: center; margin: 40px 0;">
                    <a href="#order_form" style="
                        display: inline-block;
                        font-size: 24px;
                        font-weight: bold;
                        color: white;
                        background: linear-gradient(to right, #FF5722, #E91E63);
                        padding: 16px 40px;
                        border: none;
                        border-radius: 50px;
                        text-decoration: none;
                        box-shadow: 0 0 10px rgba(233, 30, 99, 0.6);
                        animation: pulse 1.5s infinite;
                        transition: transform 0.3s ease;
                    ">
                         অর্ডার করতে ক্লিক করুন 
                    </a>
                </div>
                
                
            
            </div>
        </div>
    </div>
</section>
@if(optional($campaign_data)->description && strlen($campaign_data->description) > 15)
{!!$campaign_data->description !!} 
@endif
<section class="my-3 my-md-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="campro_inn">
                    <div class="campro_head">
                        <h2 class="text-center mb-3">{{$campaign_data->product->productName}}</h2>
                    </div>

                    <div class="campro_img_slider owl-carousel">
                        @if($campaign_data->image_one)
                       <div class="campro_img_item" style="border:5px solid red;" class="rounded">
                           <img  class="rounded" src="{{asset('public/campaigns/'.$campaign_data->image_one)}}" alt="">
                       </div> 
                       @endif
                        @if($campaign_data->image_two)
                       <div class="campro_img_item" style="border:5px solid red;" class="rounded">
                           <img  class="rounded" src="{{asset('public/campaigns/'.$campaign_data->image_two)}}" alt="">
                       </div> 
                       @endif
                        @if($campaign_data->image_three)
                       <div class="campro_img_item" style="border:5px solid red;" class="rounded">
                           <img  src="{{asset('public/campaigns/'.$campaign_data->image_three)}}" alt="">
                       </div>
                       @endif
                    </div>
                    <div style="text-align: center; margin: 40px 0;">
                        <a href="#order_form" style="
                            display: inline-block;
                            font-size: 24px;
                            font-weight: bold;
                            color: white;
                            background: linear-gradient(to right, #FF5722, #E91E63);
                            padding: 16px 40px;
                            border: none;
                            border-radius: 50px;
                            text-decoration: none;
                            box-shadow: 0 0 10px rgba(233, 30, 99, 0.6);
                            animation: pulse 1.5s infinite;
                            transition: transform 0.3s ease;
                        ">
                             অর্ডার করতে ক্লিক করুন 
                        </a>
                    </div>
                 
                </div>

            </div>
        </div>
    </div>
</section>
<section class="section-content padding-y bg slidetop" id="order_form" style="background: linear-gradient(to bottom, #FFEC84, #FFFFFF);">
    <div class="container">
        <h2 class="campaign_offer text-center mb-4">অফারটি সীমিত সময়ের জন্য, তাই অফার শেষ হওয়ার আগেই অর্ডার করুন</h2>
        <div class="row">
            <div class="col-md-6">
                <aside class="card mb-4">
                    <article class="card-body">
                        <header class="mb-4">
                            <p class="text-center" style="font-size: 16px;">অর্ডারটি কনফার্ম করতে আপনার নাম, ঠিকানা,
                                মোবাইল নাম্বার, লিখে <span class="text-danger">অর্ডার কনফার্ম করুন</span> বাটনে
                                ক্লিক করুন
                            </p>
                        </header>
                        <div class="row">
                                <div class="form-group col-sm-12">
                                    <label>আপনার নাম </label>
                                    <input onchange="saveInput()" type="text" id="customerName" placeholder="আপনার নাম লিখুন" class="form-control">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>আপনার মোবাইল নম্বর </label>
                                    <input onchange="saveInput()" type="number" pattern="[0-9]*" id="customerPhone" placeholder="আপনার মোবাইল নম্বর লিখুন"
                                           class="form-control">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>আপনার সম্পূর্ণ ঠিকানা </label>
                                    <input onchange="saveInput()" type="text"  id="customerAddress" class="form-control"
                                           placeholder="আপনার ঠিকানা সম্পূর্ণ  লিখুন">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Select Area </label>
                                    @php
                                    $shipingCharges = App\ShippingCharge::all();
                                    @endphp
                                    <select onchange="saveInput()" name="area" id="selectCourier" class="form-control">
                                       <option value=""> Select Area</option>
                                        @foreach($shipingCharges as $shipingCharge)
                                        <option value="{{$shipingCharge->charge}}"> {{$shipingCharge->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--
                                <div class="form-group col-sm-12">
                                    <label class="form-label d-block">Select Area <span class="text-danger">*</span></label>
                                    @php
                                        $shipingCharges = App\ShippingCharge::all();
                                    @endphp
                                    @if ($shipingCharges->isNotEmpty())
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            @foreach ($shipingCharges as $index => $shipingCharge)
                                                <label class="btn btn-outline-primary {{ $index === 0 ? 'active' : '' }}">
                                                    <input 
                                                        type="radio" 
                                                        name="area" 
                                                        id="area-{{ $shipingCharge->id }}" 
                                                        value="{{ $shipingCharge->charge }}" 
                                                        autocomplete="off" 
                                                        {{ $index === 0 ? 'checked' : '' }}
                                                        required
                                                    >
                                                    {{ $shipingCharge->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No shipping charges available.</p>
                                    @endif
                                </div>
                                --}}
                            </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="orderConfirm"
                                        class="btn btn-lg btn-info btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                        style="font-size:20px !important;"> অর্ডার কনফার্ম করুন </button>
                            </div>
                            
                        </div>
                    </article> <!-- card-body.// -->
                </aside>
            </div>
            <div class="col-md-6 orderDetails">
                <aside class="card">
                    <article class="card-body">
                        <header class="mb-4">
                            <h4 class="card-title" style="font-size: 16px;">আপনার অর্ডার</h4>
                        </header>
                        <div class="row">
                            <div class="table-responsive bg-white">
                                <table class="table border-bottom">
                                    <thead>
                                    <tr>
                                        <th class="product-image">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quanity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                       
                                    @foreach(Cart::content() as $item)
                                
                                    <tr class="cart-item">
                                        <td class="product-image" style="display: flex; flex-direction: row-reverse;">
                                            <a href="#" >
                                                <img class="lazyload" src="{{ url('/public/product/thumbnail/'.$item->model->productImage) }}" style="max-width: 50px">
                                            </a>
                                            <button href="#"  onclick="removeFromCart('{{ $item->rowId }}')" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>

                                        <td class="product-name">
                                            
                                            <span class="d-block">{{ $item->model->productName }}</span>
                                            <?php if($item->options->colorName){ ?>
                                                <small class="text-muted" >Color: <?php echo $item->options->colorName; ?>,</small>
                                            <?php } ?>
                                            <?php if($item->options->colorName){ ?>
                                                <small class="text-muted">Size: <?php echo $item->options->sizeName; ?></small>
                                            <?php } ?>
                                            {{--
                                            @if ($item->model->colors->isNotEmpty())
                                                <select onchange="updateCartOptions('{{ $item->rowId }}', this.value, 'colorName')" class="form-control form-control-sm mt-2">
                                                    <option value="">Select Color</option>
                                                    @foreach ($item->model->colors as $color)
                                                        <option value="{{ $color->colorName }}" {{ $color->colorName == $item->options->colorName ? 'selected' : '' }}>
                                                            {{ $color->colorName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                
                                            @if ($item->model->sizes->isNotEmpty())
                                                <select onchange="updateCartOptions('{{ $item->rowId }}', this.value, 'sizeName')" class="form-control form-control-sm mt-2">
                                                    <option value="">Select Size</option>
                                                    @foreach ($item->model->sizes as $size)
                                                        <option value="{{ $size->sizeName }}" {{ $size->sizeName == $item->options->sizeName ? 'selected' : '' }}>
                                                            {{ $size->sizeName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            --}}
                                        </td>

                                        <td class="product-price">
                                            <span class="d-block">TK {{ $item->model->price() }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="input-group input-spinner">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-light btn-number" type="button" data-type="plus" data-field="quantity[{{ $item->id }}]"> + </button>
                                                </div>
                                                <input type="text" name="quantity[{{ $item->id }}]" class="form-control input-number" placeholder="1" value="{{ $item->qty }}" min="1" max="10" onchange="updateQuantity('{{ $item->rowId }}', this)">
                                                <div class="input-group-append">
                                                    <button class="btn btn-light btn-number" type="button" data-type="minus"  data-field="quantity[{{ $item->id }}]"> − </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-total">
                                            <span>TK {{Cart::subtotal('0','','')}}</span>
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                  
                                </table>
                                
                            </div>
                        </div>
                    </article>
                    <article class="card-body border-top">
                        <dl class="row">
                            <dt class="col-sm-8">Subtotal: </dt>
                            <dd class="col-sm-4 text-right"><strong>TK <?php echo Cart::total('0') ?></strong></dd>

                            <dt class="col-sm-8">Delivery charge: </dt>
                            <dd class="col-sm-4 text-danger text-right"><strong>TK <?php echo $_SESSION['delivery'] ?></strong></dd>

                            <dt class="col-sm-8">Total:</dt>
                            <dd class="col-sm-4 text-right"><strong class="h5 text-dark">TK <?php echo Cart::subtotal('0','','')+$_SESSION['delivery']; ?></strong></dd>                            </dl>

                    </article>
                
                </aside>
            </div>

        </div>
    </div>
</section>
<script src="{{asset('assets/js/lazyload.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $('.campro_img_slider').owlCarousel({   
        dots: false,
        arrow: false,
        autoplay: true,
        loop: true,
        margin: 10,
        smartSpeed: 1000,
        mouseDrag: true,
        touchDrag: true,
        items: 3,
        responsiveClass: true,
        responsive: {
            300: {
                items: 1,
            },
            480: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1170: {
                items: 3,
            },
        }
    });
</script>
<script>
    $(document).ready(function() {
        updateNavCart();
        
    });
    function showFrontendAlert(type, message) {
        if (type === 'danger') {
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
    function updateNavCart() {
        $.ajax({
            type: "get",
            url: "{{url('/miniCart')}}",
            contentType: "application/json",
            success: function (response) {
                $('#cart_items').empty().prepend(response);
            }
        });
    }

    function removeFromCart(key) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "DELETE",
            url: "{{url('/checkout')}}/" + key,
            data: {
                '_token': '{{ csrf_token() }}'
            },
            contentType: "application/json",
            success: function (response) {

                showFrontendAlert('success', 'Successfully Product Removed from Cart');
                updateNavCart();
                updateQuantity(key,0);
                if(response['reload'] === 'true'){
                    location.reload();
                }

            }
        });
    }

    function updateQuantity(key, element){
        $.get("{{url('/updateQuantity')}}", { _token:'30aK3OPPMnzZeq8BKYZGsidbBTm5VsnwPGhJdtPl', key:key, quantity: element.value}, function(data){
            updateNavCart();
            $('.orderDetails').html(data);
        });
    }
    function updateCartOptions(key, value, optionType) {
      
        $.get("{{ route('updateCartOptions') }}", {
            _token: '{{ csrf_token() }}', // Include CSRF token
            key: key,
            [optionType] : value
        }, function(data) {
            updateNavCart(); // Update the navigation cart
            $('.orderDetails').html(data); // Update the order details with the new cart HTML
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error updating cart options:', textStatus, errorThrown);
            alert('Could not update cart options. Please try again.');
        });
    }

    function addToCart(id) {
        var colorId = $('input[name="color"]:checked').val();
        var sizeId = $('input[name="size"]:checked').val();
        var quantity = $('input[name="quantity"]').val() || 1;
        $.post("{{url('/checkout')}}", {
            _token: '{{ csrf_token() }}',
            id: id,
            quantity: quantity,
            color_id: colorId,
            size_id: sizeId
        }, function (data) {
            console.log(data.message);
            showFrontendAlert(data.status, data.message);
            updateNavCart();
          
        });
    }

    function buyNow(id) {
        var colorId = $('input[name="color"]:checked').val();
        var sizeId = $('input[name="size"]:checked').val();
        var quantity = $('input[name="quantity"]').val() || 1;
    
       // Check if color and size are selected
        if ($('#color-select').length && !colorId) {
            showFrontendAlert('error', 'Please select a color.');
            return;
        }

        if ($('#size-select').length && !sizeId) {
            showFrontendAlert('error', 'Please select a size.');
            return;
        }
        $.post("{{url('/checkout')}}", {
            _token: '{{ csrf_token() }}',
            id: id,
            quantity: quantity,
            color_id: colorId,
            size_id: sizeId
        }, function (data) {
            showFrontendAlert(data.status, data.message);
            updateNavCart();
            if(data.status == 'success'){
                window.location.href = '{{url('/checkout')}}';
            }
            
        });
    }


    function cartQuantityInitialize() {
        $('.btn-number').click(function (e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }


</script>
<script>
        $(document).ready(function () {
            //updateQuantity(0,0);
            $('#selectCourier').on('change',function (e) {
                var selectCourier = +$('#selectCourier option:selected').val();
                $.ajax({
                    type: "get",
                    url: "{{url('/updateDeliveryCharge')}}",
                    data: {
                        'selectCourier':selectCourier,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function () {
                        updateQuantity(0,0);
                    }
                });
            });
            // $('input[name="area"]').on('change', function () {
            //     var selectedCourier = $('input[name="area"]:checked'); // Get the checked radio button
            //     var selectCourier = selectedCourier.val(); // Get the value of the checked radio button
            
            //     $.ajax({
            //         type: "get",
            //         url: "{{url('/updateDeliveryCharge')}}",
            //         data: {
            //             'selectCourier': selectCourier,
            //             '_token': '{{ csrf_token() }}'
            //         },
            //         success: function () {
            //             updateQuantity(0, 0); // Call the updateQuantity function upon successful response
            //         }
            //     });
            // });

            $(document).on("click", "#orderConfirm", function () {
                constantValue = 0;
                var bdPhoneRegex = /^(013|014|015|016|017|018|019)\d{8}$/;
                var customerName = $('#customerName');
                var customerAddress = $('#customerAddress');
                var customerPhone = $('#customerPhone');
                var selectCourier = $('#selectCourier option:selected');
                
                // Log all values
                
                
                
                if (!customerName.val()) {
                    customerName.addClass("has-error");
                    constantValue = 1;
                    showFrontendAlert('error', 'Invalied Customenr Name!');
                }
                if (!customerAddress.val()) {
                    customerAddress.addClass("has-error");
                    constantValue = 1;
                    showFrontendAlert('error', 'Invalied Customer Address!');
                }
                if (!customerPhone.val()) {
                    customerPhone.addClass("has-error");
                    constantValue = 1;
                    showFrontendAlert('error', 'Invalied Phone Number!');
                }
                if (!bdPhoneRegex.test(customerPhone.val())) {
                    customerPhone.addClass("has-error");
                    constantValue = 1;
                    showFrontendAlert('error', 'Invalied Phone Number!');
                }
                
                if (selectCourier.val() === '') {
                    selectCourier.addClass("has-error");
                    showFrontendAlert('error', 'Unsuccessful to Place order');
                    constantValue = 1;
                }
                // console.log(selectCourier); // Log the selected charge value

                // if (!selectCourier) {
                    
                //     // If no radio button is selected, handle the error
                //     $('input[name="area"]').closest('.form-group').addClass("has-error");
                //     showFrontendAlert('error', 'Please Aelect Area');
                //     constantValue = 1;
                // }
                console.log("Customer Name:", customerName.val());
                console.log("Customer Address:", customerAddress.val());
                console.log("Customer Phone:", customerPhone.val());
                console.log("Is Phone Valid:", bdPhoneRegex.test(customerPhone.val()));
                console.log("Selected Courier:", selectCourier.val(), "-", selectCourier.text());
                if (constantValue === 1) {
                    $('html, body').animate(  {  scrollTop: $('body').position().top  },  500   );
                } else {
                    $.ajax({
                        type: "post",
                        url: "{{url('/placeOrder')}}",
                        data: {
                            'customerName': customerName.val(),
                            'customerAddress': customerAddress.val(),
                            'customerPhone': customerPhone.val(),
                            'selectCourier': selectCourier.val(),
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            if(data['status'] === 'success'){
                                showFrontendAlert('success', 'Successfully Place order');
                                window.location.href = data['link'];

                            }else if(data['status'] === 'blocked'){
                                showFrontendAlert('error', data['message']);
                            }
                            else{
                                showFrontendAlert('error', 'Unsuccessful to Place order');

                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', error);
                            console.log('Status:', status);
                            console.log('Response:', xhr.responseText);
                            showFrontendAlert('error', 'Something went wrong while placing the order. Please try again.');
                        }
                    });
                }
            });
        });

        
    </script>
    <script>

function saveInput() {
    let customerPhone = document.querySelector('#customerPhone')?.value;
    let customerName = document.querySelector('#customerName')?.value;
    let customerAddress = document.querySelector('#customerAddress')?.value;
    let selectCourier = document.querySelector('#selectCourier')?.value;
    let csrfToken = '{{ csrf_token() }}';
    
    console.log("Customer Phone:", customerPhone);
    console.log("Customer Name:", customerName);
    console.log("Customer Address:", customerAddress);
    console.log("Selected Courier:", selectCourier);
    console.log("CSRF Token:", csrfToken);


    fetch("{{ url('/save-input') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            customerPhone,
            customerName,
            customerAddress,
            selectCourier
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);
        // Show success message or handle response
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


</script>
@stack('js')
</body>

</html>
