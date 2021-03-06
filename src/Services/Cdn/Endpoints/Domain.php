<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Response;

class Domain
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
     * Get All User Domains.
     *
     * @return Response
     */
    public function all(): Response
    {
        return $this->http->get('domains');
    }

    /**
     * Create New User Domain.
     *
     * @param string $domain
     *
     * @return Response
     */
    public function create(string $domain): Response
    {
        return $this->http->post('domains/dns-service', [
            'domain' => $domain,
        ]);
    }

    /**
     * Get User Domain.
     *
     * @param string|null $domain
     *
     * @return Response
     */
    public function get(string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain);

        return $this->http->get($url);
    }

    /**
     * Delete User Domain.
     *
     * @param string|null $domain
     *
     * @return Response
     */
    public function delete(string $domain = null): Response
    {
        $id = $this->get($domain ?? $this->domain)['id'];
        $url = 'domains/'.($domain ?? $this->domain)."?id=$id";

        return $this->http->delete($url);
    }
}
