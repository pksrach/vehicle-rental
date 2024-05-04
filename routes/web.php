<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\frontend\AboutController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\frontend\HomeController;  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.home.index');
// });

// Manage Backend Routes
// Need to use middleware auth to protect the routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard');

    Route::group(['prefix' => 'vehicle-management'], function () {
        // Vehicle
        Route::group(['prefix' => 'vehicles'], function () {
            Route::get('/', [VehicleController::class, 'index'])->name('backend.vehicles.index');
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
Route::group(['prefix' => 'ui'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
    Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');
});