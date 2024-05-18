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

        try {
            $this->validate($request, [
                'username' => 'required|unique:users,username',
                'email' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required', // Use confirmed rule for password confirmation
            ]);
            if ($request->password != $request->password_confirmation) {
                return back()->withErrors(['password' => 'Password and confirm password does not match']);
            }
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->user_type = 1;
            $user->save();

            return redirect()->route('frontend.home');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors()); // Handle validation errors
        }
    }
}
