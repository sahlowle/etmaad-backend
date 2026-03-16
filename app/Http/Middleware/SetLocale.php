<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language');

        if (! $locale) {
            $locale = config('app.locale');
        }

        $allowed = ['en', 'ar'];

        if (! in_array($locale, $allowed)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        $response = $next($request);
        $response->headers->set('Content-Language', App::currentLocale());

        return $response;
    }
}
