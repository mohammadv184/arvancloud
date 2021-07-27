<?php


namespace Mohammadv184\ArvanCloud\Auth;


class ApiKey implements Auth
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey=$apiKey;
    }

    public function getHeaders(): array
    {
        return [
            'Authorization'=>$this->apiKey
        ];
    }
}