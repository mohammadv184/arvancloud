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

    /**
     * Response constructor.
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;

        $this->date = Carbon::now();
    }

    /**
     * @return Carbon
     */
    public function GetDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function GetService(): string
    {
        return $this->service;
    }

}