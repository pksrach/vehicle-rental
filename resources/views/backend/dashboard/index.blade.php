@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a id="filter-today" class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Sales <span>| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="sales-count">0</h6>
                                    <span id="sales-percentage" class="text-success small pt-1 fw-bold">0%</span>
                                    <span class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Revenue <span>| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="sales-sum">$0</h6>
                                    <span class="text-success small pt-1 fw-bold">8%</span> <span
                                        class="text-muted small pt-2 ps-1">increase</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Customers <span>| All</span></h5>

                            <div class="d-flex align-items-center">
                                <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="customer-count">0</h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->

                <!-- Top Vehicle rent Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                            <li>
                                <div class="export">
                                    <a class="icon" href="{{ route('top-rent.export.pdf') }}">
                                        <i class="bi bi-download"></i> Export PDF
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Top Vehicle Rent Traffic <span>| This Month</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                fetch('{{route('backend.dashboard.get-top-rent')}}')
                                    .then(response => response.json())
                                    .then(data => {
                                        echarts.init(document.querySelector("#trafficChart")).setOption({
                                            tooltip: {
                                                trigger: 'item'
                                            },
                                            legend: {
                                                top: '5%',
                                                left: 'center'
                                            },
                                            series: [{
                                                name: 'Top Vehicle Rent',
                                                type: 'pie',
                                                radius: ['40%', '70%'],
                                                avoidLabelOverlap: false,
                                                label: {
                                                    show: false,
                                                    position: 'center'
                                                },
                                                emphasis: {
                                                    label: {
                                                        show: true,
                                                        fontSize: '18',
                                                        fontWeight: 'bold'
                                                    }
                                                },
                                                labelLine: {
                                                    show: false
                                                },
                                                data: data // Use the data from the server
                                            }]
                                        });
                                    });
                            });
                        </script>

                    </div>
                </div>
                <!-- End Top Vehicle rent Traffic -->

                <!-- Reports -->
                <div class="col-12">
                    <div class="card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Reports <span>/Today</span></h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    fetch('{{route('backend.dashboard.get-report-data')}}')
                                        .then(response => response.json())
                                        .then(data => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Sales',
                                                    data: data.sales,
                                                }, {
                                                    name: 'Revenue',
                                                    data: data.revenue
                                                }, {
                                                    name: 'Customers',
                                                    data: data.customers
                                                }],
                                                // ... rest of your chart configuration
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: data.categories // Use the categories from the server
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>

                    </div>
                </div>
                <!-- End Reports -->
            </div>

        </div>
    </section>
@endsection

@section('myScript')
    {{--Count sales--}}
    <script>
        $(document).ready(function () {
            $('.dropdown-item').click(function (e) {
                e.preventDefault();
                var period = $(this).text().toLowerCase(); // get the text of the clicked item

                $.ajax({
                    url: "{{ route('backend.dashboard.get-booking-counts') }}",
                    type: 'GET',
                    data: {period: period}, // send the period as a parameter
                    success: function (data) {
                        $('#sales-count').text(data.count);
                        $('#sales-percentage').text(data.percentage + '%');
                        var sum = parseFloat(data.sum);
                        if (isNaN(sum)) {
                            sum = 0;
                        }
                        var formattedSum = sum.toLocaleString('en-US', {
                            style: 'currency',
                            currency: 'USD'
                        });
                        $('#sales-sum').text(formattedSum); // update the sum
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            $('#filter-today').trigger('click');
        });
    </script>

    {{--Count customer--}}
    <script>
        $('.dropdown-item').click(function (e) {
            $.ajax({
                url: "{{ route('backend.dashboard.get-customer-counts') }}",
                type: 'GET',
                success: function (data) {
                    $('#customer-count').text(data.count); // update the customer count
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>

    {{--Report data--}}

@endsection
