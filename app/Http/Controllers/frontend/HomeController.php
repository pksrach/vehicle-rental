<?php

namespace App\Http\Controllers\frontend;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $data['vehicles'] = Vehicle::where('is_active', 1)->orderBy('id', 'desc')->limit(20)->get();
        return view('frontend.home.index', $data);
    }
}
