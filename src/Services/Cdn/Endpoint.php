<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn;

use Mohammadv184\ArvanCloud\Adapter\Adapter;

abstract class Endpoint
{
    protected $http;

    protected $domain;

    public function __construct(Adapter $http, string $defaultDomain, string $domain = null)
    {
        $this->http = $http;

        $this->domain = $domain ?? $defaultDomain;
    }
}
