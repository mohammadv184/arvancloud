<?php

namespace Mohammadv184\ArvanCloud;

use Carbon\Carbon;
use Mohammadv184\ArvanCloud\Traits\HasData;

class Response implements \ArrayAccess
{
    use HasData;

    /**
     * Response Date.
     *
     * @var Carbon
     */
    protected $date;

    /**
     * Response ArvanCloud Service.
     *
     * @var string
     */
    protected $service;

    /**
     * Response Message.
     *
     * @var string
     */
    protected $message;

    /**
     * Response constructor.
     *
     * @param string      $service
     * @param string|null $message
     */
    public function __construct(string $service, string $message = null)
    {
        $this->service = $service;
        $this->message = $message;
        $this->date = Carbon::now();
    }

    /**
     * Get Response Date.
     *
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * Get Response ArvanCloud Service.
     *
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Get Response Message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * set Response Data.
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data($name, $value);
    }

    /**
     * get Response Data.
     *
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->GetData($name);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return mixed|void
     */
    public function offsetSet($offset, $value)
    {
        return $this->data[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}
