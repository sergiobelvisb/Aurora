<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAurora
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('userID')) {
            return redirect()->route('login.form');
        }

        return $next($request);
    }
}