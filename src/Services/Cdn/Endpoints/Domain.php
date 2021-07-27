<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Domain extends Endpoint
{
    public function all()
    {
        return $this->http->get('domains');
    }

    public function create($domain)
    {
        return $this->http->post('domains/dns-service', [
            'domain' => $domain,
        ]);
    }

    public function get($domain = null)
    {
        $url = 'domains/'.($domain ?? $this->domain);

        return $this->http->get($url);
    }

    public function delete($domain = null)
    {
        $id = $this->get($domain ?? $this->domain)['id'];
        $url = 'domains/'.($domain ?? $this->domain)."?id=$id";

        return $this->http->delete($url);
    }
}
