<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Response;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Dns extends Endpoint
{
    /**
     * Get All Domain Dns.
     *
     * @param string|null $domain
     *
     * @return Response
     */
    public function all(string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/dns-records';

        return $this->http->get($url);
    }

    /**
     * Create new Domain Dns.
     *
     * @param array       $data
     * @param string|null $domain
     *
     * @return Response
     */
    public function create(array $data, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/dns-records';

        return $this->http->post($url, $data);
    }

    /**
     * Get Domain Dns Settings.
     *
     * @param string      $id
     * @param string|null $domain
     *
     * @return Response
     */
    public function get(string $id, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/dns-records/'.$id;

        return $this->http->get($url);
    }

    /**
     * Update Domain Dns Settings.
     *
     * @param string      $id
     * @param array       $data
     * @param string|null $domain
     *
     * @return Response
     */
    public function update(string $id, array $data, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/dns-records/'.$id;

        return $this->http->put($url, $data);
    }

    /**
     * Delete Domain Dns.
     *
     * @param string      $id
     * @param string|null $domain
     *
     * @return Response
     */
    public function delete(string $id, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/dns-records/'.$id;

        return $this->http->delete($url);
    }

    /**
     * Update Domain Dns Cloud Status.
     *
     * @param string      $id
     * @param bool        $status
     * @param string|null $domain
     *
     * @return Response
     */
    public function cloud(string $id, bool $status = true, string $domain = null): Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/dns-records/'.$id.'/cloud';

        return $this->http->put($url, [
            'cloud'=> $status,
        ]);
    }
}
