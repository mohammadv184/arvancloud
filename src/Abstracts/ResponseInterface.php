<?php


namespace Mohammadv184\ArvanCloud\Abstracts;


use Carbon\Carbon;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function GetService():string;

    /**
     * @return Carbon
     */
    public function GetDate():Carbon;

}