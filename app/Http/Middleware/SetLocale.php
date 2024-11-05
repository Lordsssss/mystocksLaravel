<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $locale = Auth::user()->language;
            App::setLocale($locale);

            // Add logging to confirm the middleware is running correctly
            Log::info('SetLocale Middleware - Language set to: ' . $locale);
        } else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}

