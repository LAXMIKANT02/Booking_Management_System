<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has an admin role (assuming user_type=1 is admin)
        if (auth()->check() && auth()->user()->user_type === 1) {
            return $next($request);
        }

        // If the user is not an admin, redirect them to the homepage or login page
        return redirect('/')->with('error', 'Access Denied. Admins only.');
    }
}
