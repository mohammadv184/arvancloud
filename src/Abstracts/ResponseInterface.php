<?php


namespace Mohammadv184\ArvanCloud\Abstracts;


use Carbon\Carbon;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function getService():string;

    /**
     * @return Carbon
     */
    public function getDate():Carbon;

    public function getMessage():string;

}