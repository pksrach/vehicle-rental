<?php

use App\Http\Controllers\Backend\DashboardController;
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
});



    
// Manage Frontend Routes
// Need to use middleware auth to protect the routes
 Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
