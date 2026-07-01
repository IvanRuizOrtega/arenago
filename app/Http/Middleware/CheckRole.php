<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!isAuth()) abort(401, 'No autorizada, requiere inicio de sesión.');
        if (!authCheckRole(...$roles)) abort(403, 'No tienes permiso para acceder a esta sección.');
        return $next($request);
    }
}
