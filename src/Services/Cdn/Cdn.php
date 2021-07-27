<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn;

use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Exception\InvalidArgument;
use Mohammadv184\ArvanCloud\Services\API;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Cache;

/**
 * Class Cdn.
 *
 * @method Cache cache(string $domain = null)
 * @method Cache dns(string $domain = null)
 * @method Cache domain(string $domain = null)
 * @method Cache ssl(string $domain = null)
 */
class Cdn implements API
{
    protected $http;

    protected $config;

    public function __construct(Adapter $http, array $config)
    {
        $this->http = $http;
        $this->config = $config;
    }

    /**
     * @throws InvalidArgument
     */
    public function __call($name, $arguments)
    {
        $endpoints = $this->config['endpoints'];
        if (!key_exists(strtolower($name), $endpoints)) {
            throw new InvalidArgument("{$name} endpoint is invalid");
        }
        $domain = $this->config['domain'];

        return new $endpoints[strtolower($name)]($this->http, $domain, ...$arguments);
    }
}
