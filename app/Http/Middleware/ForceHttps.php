<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Force HTTPS if configured
        if (config('ssl.force_https', true) && !$request->secure() && !$request->is('health')) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        // Set HTTPS scheme for URL generation
        if ($request->secure() || config('ssl.force_https', true)) {
            URL::forceScheme('https');
        }

        // Add security headers
        if ($request->secure()) {
            $hstsMaxAge = config('ssl.hsts_max_age', 31536000);
            if ($hstsMaxAge > 0) {
                $response->headers->set('Strict-Transport-Security', "max-age={$hstsMaxAge}; includeSubDomains; preload");
            }
        }

        return $response;
    }
}

