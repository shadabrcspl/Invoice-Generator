<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SEC-11: Security Headers Middleware
 *
 * Adds HTTP security headers to every response to reduce the attack surface
 * for XSS, clickjacking, MIME sniffing, and information leakage.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \Illuminate\Http\Response $response */
        $response = $next($request);

        // Prevent browsers from MIME-sniffing (e.g. serving SVG as text/html)
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Prevent clickjacking — deny all iframes
        $response->headers->set('X-Frame-Options', 'DENY');

        // Enforce HTTPS for 1 year, include subdomains
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains'
        );

        // Stop old IE from running downloads in the app context
        $response->headers->set('X-Download-Options', 'noopen');

        // Don't send referrer info to third parties
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions policy — restrict browser features
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=()'
        );

        // Content-Security-Policy — whitelist trusted sources
        // Allows: self, Bootstrap CDN, Google Fonts, Chart.js
        $response->headers->set(
            'Content-Security-Policy',
            implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' cdn.jsdelivr.net",
                "style-src 'self' 'unsafe-inline' cdn.jsdelivr.net fonts.googleapis.com",
                "font-src 'self' fonts.gstatic.com cdn.jsdelivr.net",
                "img-src 'self' data: blob:",
                "connect-src 'self' cdn.jsdelivr.net",
                "frame-ancestors 'none'",
                "object-src 'none'",
                "base-uri 'self'",
            ])
        );

        // Remove information disclosure headers
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
