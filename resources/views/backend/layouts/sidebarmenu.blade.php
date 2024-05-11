<?php

use Illuminate\Support\Facades\Request;

$isMainRouteVehicleManagement = Request::is('admin/vehicle-management/*');
$isVehicleRoute = Request::is('admin/vehicle-management/vehicles', 'admin/vehicle-management/vehicles/*');
$isBrandRoute = Request::is('admin/vehicle-management/brands', 'admin/vehicle-management/brands/*');
$isCategoryRoute = Request::is('admin/vehicle-management/categories', 'admin/vehicle-management/categories/*');
$isLocationRoute = Request::is('admin/vehicle-management/locations', 'admin/vehicle-management/locations/*');

$isMainRouteBookedManagement = Request::is('admin/booking-management/*');
$isBookingRoute = Request::is('admin/booking-management/bookings', 'admin/booking-management/bookings/*');
$isPaymentMethodRoute = Request::is('admin/booking-management/payment-methods', 'admin/booking-management/payment-method/*');

$isMainRouteUserManagement = Request::is('admin/user-management/*');
$isCustomerRoute = Request::is('admin/user-management/customers', 'admin/user-management/customers/*');
$isStaffRoute = Request::is('admin/user-management/staffs', 'admin/user-management/staffs/*');
$isUserRoute = Request::is('admin/user-management/users', 'admin/user-management/users/*');

$isMainRouteReportManagement = Request::is('admin/report-management/*');
$isSaleServiceRoute = Request::is('admin/report-management/sales-services', 'admin/report-management/sales-services/*');
?>
        <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('backend.dashboard') ? 'active' : '' }}"
               href="{{route('backend.dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <!-- Vehicle -->
        <li class="nav-item">
            <a class="nav-link {{ $isMainRouteVehicleManagement ? '' : 'collapsed' }}" data-bs-target="#tables-nav"
               data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Vehicle Management</span><i
                        class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse {{ $isMainRouteVehicleManagement ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{$isVehicleRoute ? 'active' : ''}}" href="{{route('backend.vehicles.index')}}">
                        <i class="bi bi-circle"></i><span>Vehicle</span>
                    </a>
                </li>
                <li>
                    <a class="{{$isBrandRoute ? 'active' : ''}}" href="{{route('backend.brands.index')}}">
                        <i class="bi bi-circle"></i><span>Brand</span>
                    </a>
                </li>
                <li>
                    <a class="{{$isCategoryRoute ? 'active' : ''}}" href="{{route('backend.categories.index')}}">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>
                <li>
                    <a class="{{$isLocationRoute ? 'active' : ''}}" href="{{route('backend.locations.index')}}">
                        <i class="bi bi-circle"></i><span>Location</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Vehicle Nav -->

        <!-- Booking -->
        <li class="nav-item">
            <a class="nav-link {{ $isMainRouteBookedManagement ? '' : 'collapsed' }}" data-bs-target="#tables-nav2"
               data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Booking Management</span><i
                        class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav2" class="nav-content collapse {{ $isMainRouteBookedManagement ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav2">
                <li>
                    <a class="{{$isBookingRoute ? 'active' : ''}}"
                       href="{{route('backend.bookings.index')}}">
                        <i class="bi bi-circle"></i><span>Booking</span>
                    </a>
                </li>
                <li>
                    <a class="{{$isPaymentMethodRoute ? 'active' : ''}}"
                       href="{{route('backend.payment_methods.index')}}">
                        <i class="bi bi-circle"></i><span>Payment Method</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Booking Nav -->

        <!-- User -->
        <li class="nav-item">
            <a class="nav-link {{ $isMainRouteUserManagement ? '' : 'collapsed' }} " data-bs-target="#tables-nav3"
               data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>User Management</span><i
                        class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav3" class="nav-content collapse {{ $isMainRouteUserManagement ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav3">
                <li>
                    <a class="{{$isCustomerRoute ? 'active' : ''}}" href="{{route('backend.customers.index')}}">
                        <i class="bi bi-circle"></i><span>Customer</span>
                    </a>
                </li>
                <li>
                    <a class="{{$isStaffRoute ? 'active' : ''}}" href="{{route('backend.staffs.index')}}">
                        <i class="bi bi-circle"></i><span>Staff</span>
                    </a>
                </li>
                <li>
                    <a class="{{$isUserRoute ? 'active' : ''}}" href="{{route('backend.users.index')}}">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End User Nav -->

        <!-- Report -->
        <li class="nav-item">
            <a class="nav-link collapsed {{ $isMainRouteReportManagement ? '' : 'collapsed' }} " data-bs-target="#tables-nav5" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Report Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav5" class="nav-content collapse {{ $isMainRouteReportManagement ? 'show' : '' }} " data-bs-parent="#sidebar-nav5">
                <li>
                    <a class="{{$isSaleServiceRoute ? 'active' : ''}}" href="{{route('backend.reports.sales-services')}}">
                        <i class="bi bi-circle"></i><span>Sale Service</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Report Nav -->

    </ul>

</aside><!-- End Sidebar-->
