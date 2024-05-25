<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KlienMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // AdminMiddleware.php
    public function handle($request, Closure $next)
    {
        if ( auth()->user()->role == 'klien') {
            return $next($request);
        }
        return abort(403);  // Sesuaikan dengan rute yang sesuai.
    }

}
