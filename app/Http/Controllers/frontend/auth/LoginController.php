<?php

namespace App\Http\Controllers\frontend\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LoginController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login.index');
    }
    public function doLogin(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            // Check if the user is authenticated
            if (auth()->attempt($request->only('username', 'password'))) {
                // Redirect to the dashboard
                return redirect()->route('frontend.home');
            }
            // Redirect back with error message
            return redirect()->back()->withInput($request->only('username'))->with('error', 'Invalid username or password. Please try again.');
        } catch (QueryException $e) {
            // Handle the error
            return view('frontend.auth.database_error');
        }
    }
}
