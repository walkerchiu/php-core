<?php

namespace WalkerChiu\Core\Middleware;

use Closure;

class CORSMiddleware
{
    /**
     * For Laravel 5.4
     * 
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
        $allowed_methods = ['*'];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Headers
        $allowed_headers = [
            'Authorization',
            'Content-Type',
            'Methods',
            'Origin'
        ];

        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Credentials
        $supports_credentials = true;

        $response = $next($request);
        return $response->header('Access-Control-Allow-Origin', implode(', ', $allowed_origins))
                        ->header('Access-Control-Allow-Methods', implode(', ', $allowed_methods))
                        ->header('Access-Control-Allow-Headers', implode(', ', $allowed_headers))
                        ->header('Access-Control-Allow-Credentials', $supports_credentials);
    }
}
