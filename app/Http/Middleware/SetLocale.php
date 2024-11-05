<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        // Check if there is a locale in the session
        $locale = Session::get('locale', Auth::user()->language);

        // Set application locale
        App::setLocale($locale);

        // Update the user's language in the database if necessary
        if (Auth::user()->language !== $locale) {
            Auth::user()->update(['language' => $locale]);
        }
        
        // Log for debugging purposes
        Log::info('SetLocale Middleware - Language set to: ' . $locale);
    } else {
        App::setLocale(config('app.locale')); // Default to the application locale
    }

    return $next($request);
}
}

