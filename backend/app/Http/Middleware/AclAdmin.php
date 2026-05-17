<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AclAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (session('acl') !== 'Administrador') {
            abort(403, 'Acceso restringido a administradores.');
        }

        return $next($request);
    }
}