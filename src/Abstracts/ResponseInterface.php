<?php

namespace Mohammadv184\ArvanCloud\Abstracts;

use Carbon\Carbon;

interface ResponseInterface
{
    /**
     * Get Response ArvanCloud Service.
     *
     * @return string
     */
    public function getService(): string;

    /**
     * Get Response Date.
     *
     * @return Carbon
     */
    public function getDate(): Carbon;

    /**
     * Get Response Message.
     *
     * @return string
     */
    public function getMessage(): string;
}
