<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

trait ClientIpTrait
{
    /**
     * @return String
     */
    public function getClientIP()
    {
        $request = Request::instance();
        $request->setTrustedProxies(
            config('wk-core.trustedProxies'),
            HttpRequest::HEADER_X_FORWARDED_ALL ^ HttpRequest::HEADER_X_FORWARDED_HOST
        );

        return $request->getClientIp();
    }
}
