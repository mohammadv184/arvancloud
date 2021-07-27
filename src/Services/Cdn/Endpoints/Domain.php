<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Response;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Domain extends Endpoint
{
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
