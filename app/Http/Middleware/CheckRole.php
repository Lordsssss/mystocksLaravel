<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @param  int  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role <= $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}