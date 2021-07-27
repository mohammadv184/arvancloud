<?php

namespace Mohammadv184\ArvanCloud\Abstracts;

use Carbon\Carbon;

abstract class Response implements ResponseInterface
{
    /**
     * Response Date
     * @var Carbon
     */
    protected $date;

    /**
     * Response ArvanCloud Service
     * @var string
     */
    protected $service;

    /**
     * Response Message
     * @var string
     */
    protected $message;

    /**
     * Response constructor.
     *
     * @param string $service
     * @param string|null $message
     */
    public function __construct(string $service,string $message = null)
    {
        $this->service = $service;
        $this->message = $message;
        $this->date = Carbon::now();
    }

    /**
     * Get Response Date
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * Get Response ArvanCloud Service
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Get Response Message
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
