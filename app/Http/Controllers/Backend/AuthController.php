<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function backendLogin(): View
    {
        return view('backend.auth.index');
    }

    public function backendDoLogin(Request $req)
    {
        try {
            $credentials = $req->only('username', 'password');
            if (auth()->attempt($credentials)) {
                $user = auth()->user();
                if ($user->user_type !== 2) {
                    auth()->logout();
                    return redirect()->back()->with('error', 'This account is not authorized to access the admin panel.');
                }
                return redirect()->route('backend.dashboard');
            }
            return redirect()->back()->withInput($req->only('username'))->with('error', 'Invalid username or password. Please try again.');
        } catch (QueryException $e) {
            // Handle the error
            return view('backend.auth.database_error');
        }
    }

    public function backendDoLogout(): RedirectResponse
    {
        Auth::logout();

        return Redirect::route('backend.login');
    }
}
