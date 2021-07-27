<?php

namespace Mohammadv184\ArvanCloud\Services;

use Mohammadv184\ArvanCloud\Adapter\Adapter;

interface API
{
    public function __construct(Adapter $http, array $config);
}
