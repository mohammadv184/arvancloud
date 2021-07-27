<?php


namespace Mohammadv184\ArvanCloud\Abstracts;


use Carbon\Carbon;

abstract class Response implements ResponseInterface
{
    /**
     * @var Carbon
     */
    protected $date;

    /**
     * @var string
     */
    protected $service;

    protected $message;
    /**
     * Response constructor.
     * @param $service
     */
    public function __construct($service,$message=null)
    {
        $this->service = $service;
        $this->message = $message;
        $this->date = Carbon::now();
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }
    public function getMessage(): string
    {
        return $this->message;
    }

}