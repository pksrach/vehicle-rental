<?php

namespace App\Http\Controllers\frontend;

use Illuminate\View\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('frontend.about.index');
    }
}
