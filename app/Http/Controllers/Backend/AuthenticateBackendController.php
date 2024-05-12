<?php

namespace App\Http\Controllers\Backend;

use App\Http\Middleware\Authenticate;

class AuthenticateBackendController extends Authenticate
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('backend.login');
        }
    }
}
