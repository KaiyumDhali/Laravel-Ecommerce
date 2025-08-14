<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and is an admin
        if (!session()->has('user_status') || session('user_status') != 1) {
            return redirect()->route('admin.login.form')->with('error', 'You must be logged in to access this area.');
        }

        // Allow the request to continue to the next middleware or controller
        return $next($request);
    }
}
