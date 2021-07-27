<?php

namespace Mohammadv184\ArvanCloud\Traits;

trait HasData
{
    /**
     * Response Data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * set Response Data.
     *
     * @param $key
     * @param null $value
     *
     * @return $this
     */
    public function data($key, $value = null)
    {
        $data = is_array($key) ? $key : [$key=>$value];

        $this->data = array_merge($this->data, $data);

        return $this;
    }

    /**
     * get Response Data.
     *
     * @param null $key
     *
     * @return mixed
     */
    public function getData($key = null)
    {
        return is_null($key)
            ? $this->data
            : $this->data[$key] ?? null;
    }
}
