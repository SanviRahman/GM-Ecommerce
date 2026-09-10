<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>POS Invoice</title>
    <meta name="viewport" content="width=75mm, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <style>
        body {
            width: 75mm;
            margin: 0 auto;
            background: #fff;
            text-align: center;
        }
        .receipt {
            width: 72mm; /* slightly reduced to avoid edge cut */
            min-height: 100mm;
            padding: 5px;
            page-break-inside: avoid;
            text-align: center;
        }
        .header, .footer, .note {
            text-align: center;
        }
        h5 {
            font-size: 14px;
            margin: 2px 0;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            text-align: center;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 5px;
            vertical-align: top;
            text-align: center;
        }
        th h5, td h5 {
            margin: 0;
            font-size: 14px;
            text-align: center;
        }
        .page-break {
            page-break-before: always;
        }
        @page {
            size: 75mm 100mm;
            margin: 0;
        }
        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>
<?php
use Illuminate\Support\Facades\DB;
$orderIDs = unserialize($invoice->order_id);
?>

@foreach ($orderIDs as $orderID)
<?php
$order = DB::table('orders')
    ->select('orders.*', 'customers.customerName', 'customers.customerPhone', 'customers.customerAddress', 'couriers.courierName', 'cities.cityName', 'zones.zoneName', 'users.name', 'stores.storeName')
    ->leftJoin('customers', 'orders.id', '=', 'customers.order_id')
    ->leftJoin('couriers', 'orders.courier_id', '=', 'couriers.id')
    ->leftJoin('cities', 'orders.city_id', '=', 'cities.id')
    ->leftJoin('zones', 'orders.zone_id', '=', 'zones.id')
    ->leftJoin('users', 'orders.user_id', '=', 'users.id')
    ->leftJoin('stores', 'orders.store_id', '=', 'stores.id')
    ->where('orders.id', '=', $orderID)->first();

$products = DB::table('order_products')
    ->join('products', 'products.id', '=', 'order_products.product_id')
    ->where('order_id', '=', $orderID)->get();
?>

<div class="receipt">
    <div class="header">
        <h5><strong>{{ $order->storeName ?? 'NAAZ' }}<strong></h5>
        <h5>Merchant ID: {{ $order->merchantID ?? '1051873' }}</h5>
    <!--    <h6>Order #: {{ $order->invoiceID }}</h6>  -->
        <h5><strong>Parcel #: {{ $order->consignment_id }}<strong></h5>
    </div>

    <div>
        <h5><strong>Customer:</strong> {{ $order->customerName }}</h5>
        <h5><strong>Phone:</strong> {{ $order->customerPhone }}</h5>
        <h5><strong>Address:</strong> {{ $order->customerAddress }}</h5>
        <h5><strong>Order Note:</strong> {{ $order->note }}</h5>
    </div>

    <table>
        <thead>
            <tr>
                <th><h5>পণ্য</h5></th>
                <th><h5>পরিমাণ</h5></th>
                <th><h5>মূল্য</h5></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>
                    <h5>{{ $product->productName }}</h5>
                    @if($product->colorName)
                        <h5 style="font-weight: normal;">Color: {{ $product->colorName }}</h5>
                    @endif
                    @if($product->sizeName)
                        <h5 style="font-weight: normal;">Size: {{ $product->sizeName }}</h5>
                    @endif
                    @if($product->optionName)
                        <h5 style="font-weight: normal;">Option: {{ $product->optionName }}</h5>
                    @endif
                </td>
                <td><h5>{{ $product->quantity }}</h5></td>
                <td><h5>{{ $product->productPrice }}৳</h5></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><h5><strong>মোট</strong></h5></td>
                <td><h5><strong>{{ $order->subTotal }}৳</strong></h5></td>
            </tr>
        </tfoot>
    </table>

    <div class="note">
        <h5>রিটার্ন করলে ডেলিভারি চার্জ নিয়ে নিতে হবে</h5>
        <h5>{{ date('h:i:s A d-m-Y', strtotime($order->orderDate)) }}</h5>
    </div>
</div>
<div class="page-break"></div>
@endforeach

<script>
    window.print();
    window.onafterprint = function() { window.close(); };
</script>
</body>
</html>
