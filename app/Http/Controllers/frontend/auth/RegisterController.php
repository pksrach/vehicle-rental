<?php

namespace App\Http\Controllers\frontend\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register()
    {

        return view('frontend.auth.register.index');
    }
    public function doRegister(Request $request)
    {
        Log('Hello');
        dd($request);
        try {
            $this->validate($request, [
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|confirmed', // Use confirmed rule for password confirmation
            ]);

            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            // Optional: Login user after registration
            // Auth::login($user);

            return redirect()->route('frontend.home');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors()); // Handle validation errors
        }
    }
}
