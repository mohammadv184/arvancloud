<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Response;

class Ssl
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
    /**
     * Get Domain Ssl Settings.
     *
     * @param string|null $domain
     *
     * @return Response
     */
    public function get(string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/ssl';

        return $this->http->get($url);
    }

    /**
     * Update Domain Ssl Settings.
     *
     * @param string      $sslType
     * @param string|null $domain
     *
     * @return Response
     */
    public function update(string $sslType, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/ssl';
        $data = [
            'ssl_type'=> $sslType,
        ];

        return $this->http->patch($url, $data);
    }
}
