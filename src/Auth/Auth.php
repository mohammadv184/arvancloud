<?php

namespace Mohammadv184\ArvanCloud\Auth;

interface Auth
{
    /**
     * get Request Headers.
     *
     * @return array
     */
    public function getHeaders(): array;
}
