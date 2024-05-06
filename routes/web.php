<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\CarController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PricingController;
use App\Http\Controllers\frontend\ServiceController;
use App\Http\Controllers\frontend\BookingController;
use Illuminate\Support\Facades\Route;

// Need to use middleware auth to protect the routes
// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard');

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
});


// Manage Frontend Routes
// Need to use middleware auth to protect the routes
Route::group(['prefix' => ''], function () {
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
    Route::get('/booking', [BookingController::class, 'index'])->name('frontend.booking');
});
