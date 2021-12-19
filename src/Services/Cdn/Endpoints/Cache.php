<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Response;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Cache extends Endpoint
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
     * Get Domain Cache settings.
     *
     * @param string|null $domain
     *
     * @return \Mohammadv184\ArvanCloud\Response
     */
    public function get(string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/caching';

        return $this->http->get($url);
    }

    /**
     * Update Domain Cache settings.
     *
     * @param array       $data
     * @param string|null $domain
     *
     * @return Response
     */
    public function update(array $data, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/caching';

        return $this->http->patch($url, $data);
    }

    /**
     * Purge Domain Cache.
     *
     * @param array|null  $urls
     * @param string|null $domain
     *
     * @return Response
     */
    public function purge(array $urls = null, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/caching';
        $data = [
            'purge'      => is_null($urls) ? 'all' : 'individual',
            'purge_urls' => $urls,
        ];

        return $this->http->delete($url, $data);
    }
}
