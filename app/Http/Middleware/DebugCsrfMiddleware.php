<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugCsrfMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('POST')) {
            logger('Headers:', $request->headers->all());
            logger('Cookies:', $request->cookies->all());
            logger('CSRF Token:', $request->header('X-CSRF-TOKEN'));
            logger('Session Token:', $request->session()->token());
        }

        return $next($request);
    }
}
