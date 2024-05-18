<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- set icon -->
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href={{ asset('frontend/assets/css/open-iconic-bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('frontend/assets/css/animate.css') }}>

    <link rel="stylesheet" href={{ asset('frontend/assets/css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('frontend/assets/css/owl.theme.default.min.css') }}>
    <link rel="stylesheet" href={{ asset('frontend/assets/css/magnific-popup.css') }}>

    <link rel="stylesheet" href={{ asset('frontend/assets/css/aos.css') }}>

    <link rel="stylesheet" href={{ asset('frontend/assets/css/ionicons.min.css') }}>

    <link rel="stylesheet" href={{ asset('frontend/assets/css/bootstrap-datepicker.css') }}>
    <link rel="stylesheet" href={{ asset('frontend/assets/css/jquery.timepicker.css') }}>


    <link rel="stylesheet" href={{ asset('frontend/assets/css/flaticon.css') }}>
    <link rel="stylesheet" href={{ asset('frontend/assets/css/icomoon.css') }}>
    <link rel="stylesheet" href={{ asset('frontend/assets/css/style.css') }}>
</head>

<body>
    @include('frontend.layout.header')
    @yield('content')
    @include('frontend.layout.footer')


    <script src={{ asset('frontend/assets/js/jquery.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery-migrate-3.0.1.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/popper.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/bootstrap.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery.easing.1.3.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery.waypoints.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery.stellar.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/owl.carousel.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/aos.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery.animateNumber.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/bootstrap-datepicker.js') }}></script>
    <script src={{ asset('frontend/assets/js/jquery.timepicker.min.js') }}></script>
    <script src={{ asset('frontend/assets/js/scrollax.min.js') }}></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src={{ asset('frontend/assets/js/google-map.js') }}></script>
    <script src={{ asset('frontend/assets/js/main.js') }}></script>
    @yield('script')

</body>

</html>
