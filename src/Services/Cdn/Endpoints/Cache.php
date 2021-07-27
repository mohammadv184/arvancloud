<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Cache extends Endpoint
{
    public function get(string $domain = null)
    {
        $url = 'domains/'.($domain ?? $this->domain).'/caching';

        return $this->http->get($url);
    }

    public function update(array $data, string $domain = null)
    {
        $url = 'domains/'.($domain ?? $this->domain).'/caching';

        return $this->http->patch($url, $data);
    }

    public function purge(array $urls = null, string $domain = null)
    {
        $url = 'domains/'.($domain ?? $this->domain).'/caching';
        $data = [
            'purge'      => is_null($urls) ? 'all' : 'individual',
            'purge_urls' => $urls,
        ];

        return $this->http->delete($url, $data);
    }
}
