<?php

namespace Mohammadv184\ArvanCloud;

use Mohammadv184\ArvanCloud\Abstracts\Response as ResponseAbstract;
use Mohammadv184\ArvanCloud\Traits\HasData;

class Response extends ResponseAbstract implements \ArrayAccess
{
    use HasData;

    /**
     * set Response Data
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data($name, $value);
    }

    /**
     * get Response Data
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->GetData($name);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
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
