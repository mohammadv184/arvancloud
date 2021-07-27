<?php

namespace Mohammadv184\ArvanCloud\Services;

use Mohammadv184\ArvanCloud\Adapter\Adapter;

interface API
{
    /**
     * API constructor.
     *
     * @param Adapter $http
     * @param array   $config
     */
    public function __construct(Adapter $http, array $config);
}
