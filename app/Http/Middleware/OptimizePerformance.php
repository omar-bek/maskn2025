<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizePerformance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add performance headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Add cache headers for static assets
        if ($request->is('*.css') || $request->is('*.js') || $request->is('*.png') || $request->is('*.jpg') || $request->is('*.jpeg') || $request->is('*.gif') || $request->is('*.svg') || $request->is('*.ico')) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000');
        }

        // Add compression headers
        if ($request->is('*.css') || $request->is('*.js')) {
            $response->headers->set('Content-Encoding', 'gzip');
        }

        return $response;
    }
}


