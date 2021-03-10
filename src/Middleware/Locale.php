<?php

namespace WalkerChiu\Core\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class Locale {
    public function handle($request, Closure $next) {
        $language = Session::get('language');
        App::setLocale($language);

        return $next($request);
    }
}
