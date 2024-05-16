<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- set icon -->
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{--csrf using with ajax--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{asset('backend/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('backend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet">

    <!-- Customize style -->
    <style>
        .nav-link {
            color: #012970;
        }

        .nav-link.active {
            color: #4154f1;
        }
    </style>
    @yield('custom-style')
</head>

<body>
<!-- ======= Sidebar Menu ======= -->
{{--@yield('sidebar-menu')--}}
