<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\Request;

trait DomainTrait
{
    /**
     * Example: example.com
     * 
     * @return String
     */
    public function getDomain(): string
    {
        $request = Request::instance();

        return preg_replace('"^\\w+://(www\\.)?"i', '', $request->getHttpHost());
    }

    /**
     * Example: example
     * 
     * @return String
     */
    public function getDomainName(): string
    {
        $domain = $this->getDomain();

        return explode('.', $domain)[0];
    }
}
