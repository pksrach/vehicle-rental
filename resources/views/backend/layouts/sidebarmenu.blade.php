<?php

use Illuminate\Support\Facades\Request;

$isMainRouteVehicleManagement = Request::is('admin/vehicle-management/*');
$isVehicleRoute = Request::is('admin/vehicle-management/vehicles', 'admin/vehicle-management/vehicles/*');
$isBrandRoute = Request::is('admin/vehicle-management/brands', 'admin/vehicle-management/brands/*');
$isCategoryRoute = Request::is('admin/vehicle-management/categories', 'admin/vehicle-management/categories/*');
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
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Location</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Vehicle Nav -->

        <!-- Booking -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav2" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Booking Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav2">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Booked</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Payment Method</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Booking Nav -->

        <!-- User -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav3" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>User Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav3">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Customer</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Staff</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End User Nav -->

        <!-- Expense -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav4" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Expense Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav4">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Expense</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Expense Type</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Expense Nav -->

        <!-- Report -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav5" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Report Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav5">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Income</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Report Nav -->

    </ul>

</aside><!-- End Sidebar-->
