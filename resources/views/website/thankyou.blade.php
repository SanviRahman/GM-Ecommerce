@extends('website.layout')
@section('content')
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="card py-3 mt-sm-3">
                    <div class="card-body text-center table-responsive">
                        <h2 class="h4 pb-3" style="color:black">আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে আমাদের কল সেন্টার থেকে ফোন করে আপনার অর্ডারটি কনফার্ম করা হবে</h2>
                        
                        <h2 class="h4 pb-3" style="color:red">কল সেন্টার ফোন নাম্বর  <br>
                        {!! Settings::get('checkout_number_text') !!}
                        </h2>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5">Invoive ID : {{$order->invoiceID}}</th>
                              
                            </tr>
                            <tr>
                                <th class="text-left">Product Name</th>
                                <th>Code</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach($orderProducts as $product)
                            <tr>
                                <td class="text-left">
                                    <span class="d-block">{{ $product->productName }}</span>
                                    @if(!empty($product->colorName))
                                        <small class="text-muted"> Color: {{ $product->colorName }} ,</small>
                                    @endif
                                    @if(!empty($product->sizeName))
                                        <small class="text-muted"> Size: {{ $product->sizeName }} ,</small>
                                    @endif
                                    @if(!empty($product->optionName))
                                        <small class="text-muted"> Option: {{ $product->optionName }} </small>
                                    @endif
                                </td>
                                <td>{{$product->productCode}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->productPrice}}</td>
                                <td>{{$product->quantity * $product->productPrice }}</td>
                                @php $total += $product->quantity * $product->productPrice @endphp
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Delivery Charge</th>
                                <th>{{$order->deliveryCharge}}</th>
                                @php $total += $order->deliveryCharge @endphp
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th>{{$total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                        
                        <a class="btn btn-primary mt-3" href="{{url('/')}}">প্রোডাক্ট বাছাই করুন</a>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

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

            $(document).on("click", "#orderConfirm", function () {
                constantValue = 0;
                var customerName = $('#customerName');
                var customerAddress = $('#customerAddress');
                var customerPhone = $('#customerPhone');
                var selectCourier = $('#selectCourier option:selected');
                if (!customerName.val()) {
                    customerName.addClass("has-error");
                    constantValue = 1;
                }
                if (!customerAddress.val()) {
                    customerAddress.addClass("has-error");
                    constantValue = 1;
                }
                if (!customerPhone.val()) {
                    customerPhone.addClass("has-error");
                    constantValue = 1;
                }
                console.log(selectCourier.val())
                if (selectCourier.val() === '') {
                    selectCourier.addClass("has-error");
                    showFrontendAlert('error', 'Unsuccessful to Place order');
                    constantValue = 1;
                }
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

                            }else{
                                showFrontendAlert('error', 'Unsuccessful to Place order');

                            }
                        }
                    });
                }
            });
        });
    </script>
    @php
        $purchaseItems = [];
        $purchaseContentIds = [];

        foreach ($orderProducts as $purchaseProduct) {
            $purchaseVariant = trim(implode(' ', array_filter([
                $purchaseProduct->colorName ?? null,
                $purchaseProduct->sizeName ?? null,
                $purchaseProduct->optionName ?? null,
            ])));

            $purchaseItems[] = [
                'id' => (string) $purchaseProduct->productCode,
                'name' => (string) $purchaseProduct->productName,
                'category' => $purchaseProduct->category ?? 'Uncategorized',
                'variant' => $purchaseVariant,
                'price' => (float) $purchaseProduct->productPrice,
                'quantity' => (int) $purchaseProduct->quantity,
            ];
            $purchaseContentIds[] = (string) $purchaseProduct->productCode;
        }
    @endphp
    <script>
        window.dataLayer = window.dataLayer || [];

        var orderValue = {{ (float) $total }};
        var orderId = {!! json_encode((string) $order->id) !!};
        var orderCurrency = 'BDT';
        var purchaseItems = {!! json_encode($purchaseItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!};
        var purchaseContentIds = {!! json_encode($purchaseContentIds, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!};

        // Clear stale ecommerce state, then send every saved order product.
        window.dataLayer.push({ ecommerce: null });
        window.dataLayer.push({
            event: 'purchase',
            ecommerce: {
                transaction_id: orderId,
                affiliation: 'Online Store',
                value: orderValue,
                currency: orderCurrency,
                coupon: {!! json_encode($order->coupon ?? 'N/A') !!},
                items: purchaseItems
            },
            user_data: {
                email: {!! json_encode($customer->customerName ?? '') !!},
                phone: {!! json_encode($customer->customerPhone ?? '') !!},
                address: {!! json_encode($customer->customerAddress ?? '') !!}
            }
        });

        if (typeof fbq === 'function') {
            fbq('track', 'Purchase', {
                content_ids: purchaseContentIds,
                contents: purchaseItems.map(function (item) {
                    return {
                        id: item.id,
                        quantity: item.quantity,
                        item_price: item.price
                    };
                }),
                content_name: 'Order Confirmation',
                content_category: 'Products',
                num_items: purchaseItems.reduce(function (totalItems, item) {
                    return totalItems + Number(item.quantity || 0);
                }, 0),
                value: orderValue,
                currency: orderCurrency
            });
        }
    </script>
    <script>
        setTimeout(function() {
            window.location.href = "{{ url('/') }}"; // Laravel blade
            // অথবা শুধু "/" ব্যবহার করুন যদি সরাসরি root redirect করতে চান
            // window.location.href = "/";
        }, 200000); // 2000 milliseconds = 2 seconds
    </script>

@endpush

