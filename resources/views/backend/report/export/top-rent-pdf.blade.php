<!DOCTYPE html>
<html>
<head>
    <title>Top Vehicle Rent Report</title>
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
<h1>Top Vehicle Rent Report</h1>
<h2>Date Range: {{ $from_date }} - {{ $to_date }}</h2>
<h2>Date Export: {{ now()->format('d-m-Y h:i a') }}</h2>

<div class="table-responsive">
    <table class="table table-dark table-striped detail-table">
        <thead>
        <tr>
            <th>Vehicle Name</th>
            <th>Rent Count</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['value'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
