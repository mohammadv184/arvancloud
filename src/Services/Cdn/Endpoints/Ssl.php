<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;

use Mohammadv184\ArvanCloud\Response;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Ssl extends Endpoint
{
    /**
     * Get Domain Ssl Settings
     * @param string|null $domain
     * @return Response
     */
    public function get(string $domain = null):Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/ssl';

        return $this->http->get($url);
    }

    /**
     * Update Domain Ssl Settings
     * @param string $sslType
     * @param string|null $domain
     * @return Response
     */
    public function update(string $sslType, string $domain = null):Response
    {
        $url = 'domains/'.($domain ?? $this->domain).'/ssl';
        $data = [
            'ssl_type'=> $sslType,
        ];

        return $this->http->patch($url, $data);
    }
}
