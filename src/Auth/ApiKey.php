<?php

namespace Mohammadv184\ArvanCloud\Auth;

class ApiKey implements Auth
{
    /**
     * ArvanCloud User apikey.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * ApiKey constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * get Request Headers.
     *
     * @return string[]
     */
    public function getHeaders(): array
    {
        return [
            'Authorization'=> $this->apiKey,
        ];
    }
}
