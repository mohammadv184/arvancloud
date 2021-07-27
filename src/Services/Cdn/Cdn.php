<?php

namespace Mohammadv184\ArvanCloud\Services\Cdn;

use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Exception\InvalidArgument;
use Mohammadv184\ArvanCloud\Services\API;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Cache;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Dns;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Domain;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Ssl;

/**
 * Class Cdn.
 *
 * @method Cache cache(string $domain = null)
 * @method Dns dns(string $domain = null)
 * @method Domain domain(string $domain = null)
 * @method Ssl ssl(string $domain = null)
 */
class Cdn implements API
{
    /**
     * ArvanCloud Http Adapter
     * @var Adapter
     */
    protected $http;

    /**
     * ArvanCloud Configs
     * @var array
     */
    protected $config;

    /**
     * Cdn constructor.
     * @param Adapter $http
     * @param array $config
     */
    public function __construct(Adapter $http, array $config)
    {
        $this->http = $http;
        $this->config = $config;
    }


    /**
     * Call Endpoints
     * @param $name
     * @param $arguments
     * @return mixed
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
