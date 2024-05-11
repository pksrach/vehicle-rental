<!DOCTYPE html>
<html>
<head>
    <title>Sale Service Report</title>
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet">

    <style>
        .master-table th {
            background-color: #f2f2f2;
        }

        .detail-table th {
            background-color: #d2d2d2;
        }

        table {
            width: 100%;
        }
    </style>
</head>
<body>
<h1>Sale Service Report</h1>
<h2>Date Export: {{ now()->format('d-m-Y h:i a') }}</h2>


@php
    $totalSale = 0;
@endphp
@foreach($bookedRecords as $record)
    <div class="table-responsive mb-3">
        <table class="table table-dark table-striped master-table">
            <tr>
                <th>Status</th>
                <th>Pickup Date</th>
                <th>Complete Date</th>
                <th>Customer</th>
                <th>Payment</th>
                <th>Staff</th>
            </tr>
            <tr>
                <td>{{ ucfirst($record->status) }}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($record->pickup_date)) }}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($record->complete_date)) }}</td>
                <td>{{$record->customer->displayName()}}</td>
                <td>{{$record->paymentMethod->displayName()}}</td>
                <td>{{$record->staff->displayName()}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-striped detail-table">
            <thead>
            <tr>
                <th>Category</th>
                <th>Brand</th>
                <th>Vehicle</th>
                <th>Service</th>
                <th>Discount</th>
                <th>After Discount</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record->booked_details as $detail)
                @php
                    $amountAfterDiscount = $detail->service_price * (1 - $detail->discount / 100);
                    $totalSale += $amountAfterDiscount;
                @endphp
                <tr>
                    <td>{{ $detail->vehicle->category->name }}</td>
                    <td>{{ $detail->vehicle->brand->name }}</td>
                    <td>{{ $detail->vehicle->name }}</td>
                    <td>{{ '$' . number_format($detail->service_price, 2) }}</td>
                    <td>{{ $detail->discount . '%' }}</td>
                    <td>{{ '$' . number_format($amountAfterDiscount, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
    </div>
@endforeach
<div>
    Total Sale: ${{ number_format($totalSale, 2) }}
</div>
</body>
</html>
