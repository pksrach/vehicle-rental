<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\frontend\AboutController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\frontend\ServiceController;
use  App\Http\Controllers\frontend\PricingController;
use  App\Http\Controllers\frontend\CarController;
use  App\Http\Controllers\frontend\ContactController;
use  App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\HomeController;

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
        });

        // Brand
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('backend.categories.index');
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
});
