<?php

namespace WalkerChiu\Core\Middleware;

use Closure;

class CommonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Closure                  $next
     * @return Mixed
     */
    public function handle($request, Closure $next)
    {
        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
        $allowed_origins = ['*'];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Methods
        $allowed_methods = [
            'DELETE',
            'GET',
            'OPTIONS',
            'PATCH',
            'POST',
            'PUT',
        ];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Headers
        $allowed_headers = [
            'Accept',
            'Authorization',
            'Cache-Control',
            'Content-Type',
            'DNT',
            'Referer',
            'If-Modified-Since',
            'Keep-Alive',
            'Origin',
            'User-Agent',
            'X-Requested-With',
        ];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Expose-Headers
        $exposed_headers = [
            'Authorization',
        ];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Credentials
        $supports_credentials = true;

        $permissions_policy = [
            'geolocation=()',
            'midi=()',
            'sync-xhr=()',
            'microphone=()',
            'camera=()',
            'magnetometer=()',
            'gyroscope=()',
            'fullscreen=(self)',
            'payment=()',
        ];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy
        $referrer_policy = 'strict-origin-when-cross-origin';

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security
        $strict_transport_security = [
            'max-age=31536000',
            'includeSubdomains',
            'preload',
        ];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options
        $x_frame_options = "SAMEORIGIN";

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options
        $x_content_type_options = "nosniff";

        $response = $next($request);
        return $response->header('Access-Control-Allow-Origin', implode(', ', $allowed_origins))
                        ->header('Access-Control-Allow-Methods', implode(', ', $allowed_methods))
                        ->header('Access-Control-Allow-Headers', implode(', ', $allowed_headers))
                        ->header('Access-Control-Expose-Headers', implode(', ', $exposed_headers))
                        ->header('Access-Control-Allow-Credentials', $supports_credentials)
                        ->header('Permissions-Policy', implode(', ', $permissions_policy))
                        ->header('Referrer-Policy', $referrer_policy)
                        ->header('Strict-Transport-Security', implode('; ', $strict_transport_security))
                        ->header('X-Frame-Options', $x_frame_options)
                        ->header('X-Content-Type-Options', $x_content_type_options);
    }
}
