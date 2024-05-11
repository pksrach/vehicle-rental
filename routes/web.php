<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AuthenticateBackendController;
use App\Http\Controllers\Backend\BookingController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\AddToCardController;
use App\Http\Controllers\frontend\auth\LoginController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\CarController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PricingController;
use App\Http\Controllers\frontend\ServiceController;
use Illuminate\Support\Facades\Route;

// Route Auth for Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AuthController::class, 'backendLogin'])->name('backend.login');
    Route::post('/login', [AuthController::class, 'backendDoLogin'])->name('backend.login.post');
    Route::get('/logout', [AuthController::class, 'backendDoLogout'])->name('backend.logout');
});

// Index route need to check in not login state to redirect to login page else redirect to dashboard
//Route::get('/admin', function () {
//    if (auth()->check()) {
//        return redirect()->route('backend.dashboard');
//    }
//    return redirect()->route('backend.login');
//});
Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'backendLogin'])->name('backend.login');
    Route::post('/login', [AuthController::class, 'backendDoLogin'])->name('backend.login.post');
});

// Admin Routes Management
Route::middleware([AuthenticateBackendController::class, 'auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard');
        Route::get('/get-booking-counts', [DashboardController::class, 'getBookingCounts'])->name('backend.dashboard.get-booking-counts');
        Route::get('/get-customer-counts', [DashboardController::class, 'getCustomerCounts'])->name('backend.dashboard.get-customer-counts');
        Route::get('/get-report-data', [DashboardController::class, 'getReportData'])->name('backend.dashboard.get-report-data');
        Route::get('/get-top-rent', [DashboardController::class, 'topVehicleRent'])->name('backend.dashboard.get-top-rent');
        Route::get('/top-rent/export/pdf', [DashboardController::class, 'topVehicleRentExportPdf'])->name('top-rent.export.pdf');

        // Vehicle Management
        Route::group(['prefix' => 'vehicle-management'], function () {
            // Vehicle
            Route::group(['prefix' => 'vehicles'], function () {
                Route::get('/', [VehicleController::class, 'index'])->name('backend.vehicles.index');
                Route::post('/create', [VehicleController::class, 'create'])->name('backend.vehicles.create');
            });

            // Brand
            Route::group(['prefix' => 'brands'], function () {
                Route::get('/', [BrandController::class, 'index'])->name('backend.brands.index');
                Route::post('/create', [BrandController::class, 'create'])->name('backend.brands.create');
            });

            // Brand
            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', [CategoryController::class, 'index'])->name('backend.categories.index');
                Route::post('/create', [CategoryController::class, 'create'])->name('backend.categories.create');
            });

            // Location
            Route::group(['prefix' => 'locations'], function () {
                Route::get('/', [LocationController::class, 'index'])->name('backend.locations.index');
                Route::post('/create', [LocationController::class, 'create'])->name('backend.locations.create');
            });
        });

        // Booking Management
        Route::group(['prefix' => 'booking-management'], function () {
            // Payment Method
            Route::group(['prefix' => 'payment-methods'], function () {
                Route::get('/', [PaymentMethodController::class, 'index'])->name('backend.payment_methods.index');
                Route::post('/create', [PaymentMethodController::class, 'create'])->name('backend.payment_methods.create');
            });

            // Booking
            Route::group(['prefix' => 'bookings'], function () {
                Route::get('/', [BookingController::class, 'index'])->name('backend.bookings.index');
                Route::post('/create', [BookingController::class, 'create'])->name('backend.bookings.create');
                Route::put('/in-progress/{id}', [BookingController::class, 'inProgress'])->name('backend.bookings.in-progress');
                Route::put('/complete/{id}', [BookingController::class, 'complete'])->name('backend.bookings.complete');
                Route::put('/cancel/{id}', [BookingController::class, 'cancel'])->name('backend.bookings.cancel');
            });
        });

        // User Management
        Route::group(['prefix' => 'user-management'], function () {
            // Customer
            Route::group(['prefix' => 'customers'], function () {
                Route::get('/', [CustomerController::class, 'index'])->name('backend.customers.index');
            });

            // Staff
            Route::group(['prefix' => 'staffs'], function () {
                Route::get('/', [StaffController::class, 'index'])->name('backend.staffs.index');
            });

            // User
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UserController::class, 'index'])->name('backend.users.index');
            });
        });

        // Report Management
        Route::group(['prefix' => 'report-management'], function () {
            Route::get('/sales-services', [ReportController::class, 'saleService'])->name('backend.reports.sales-services');
            Route::get('/sales-services/export/excel', [ReportController::class, 'saleServiceExportExcel'])->name('sales-services.export.excel');
            Route::get('/sales-services/export/pdf', [ReportController::class, 'saleServiceExportPdf'])->name('sales-services.export.pdf');
        });
    });


});


// Manage Frontend Routes
// Need to use middleware auth to protect the routes
Route::group(['prefix' => ''], function () {
    //Auth
    Route::get('/login', [LoginController::class, 'login'])->name('front.login');

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
    // About
    Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');
    // Service
    Route::get('/services', [ServiceController::class, 'index'])->name('frontend.service');
    // Pricing
    Route::get('/pricing', [PricingController::class, 'index'])->name('frontend.pricing');
    // Car
    Route::get('/car', [CarController::class, 'index'])->name('frontend.car');
    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('frontend.blog');
    // Booking
    Route::get('/booking', [AddToCardController::class, 'index'])->name('frontend.booking');
});
