<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\Request;

trait DomainTrait
{
    /**
     * Example: example.com
     */
    public function getDomain()
    {
        $request = Request::instance();

        return preg_replace('"^\\w+://(www\\.)?"i', '', $request->getHttpHost());
    }

    /**
     * Example: example
     */
    public function getDomainName()
    {
        $domain = $this->getDomain();

        return explode('.', $domain)[0];
    }
}
