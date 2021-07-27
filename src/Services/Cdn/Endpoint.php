<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn;

use Mohammadv184\ArvanCloud\Adapter\Adapter;

abstract class Endpoint
{
    /**
     * ArvanCloud Http Adapter.
     *
     * @var Adapter
     */
    protected $http;

    /**
     * User Domain.
     *
     * @var string
     */
    protected $domain;

    /**
     * Endpoint constructor.
     *
     * @param Adapter     $http
     * @param string      $defaultDomain
     * @param string|null $domain
     */
    public function __construct(Adapter $http, string $defaultDomain, string $domain = null)
    {
        $this->http = $http;

        $this->domain = $domain ?? $defaultDomain;
    }
}
