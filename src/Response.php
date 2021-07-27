<?php


namespace Mohammadv184\ArvanCloud;
use Mohammadv184\ArvanCloud\Abstracts\Response as ResponseAbstract;
use Mohammadv184\ArvanCloud\Traits\HasData;

class Response extends ResponseAbstract implements \ArrayAccess
{
    use HasData;

    public function __set($name, $value)
    {
        $this->data($name,$value);
    }

    public function __get($name)
    {
        return $this->GetData($name);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
       return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        return $this->data[$offset]=$value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}