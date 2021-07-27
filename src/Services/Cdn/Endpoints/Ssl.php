<?php


namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;


use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Ssl extends Endpoint
{
    public function get(string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/ssl';

        return $this->http->get($url);
    }
    public function update(string $sslType,string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/ssl';
        $data =[
            'ssl_type'=>$sslType
        ];
        return $this->http->patch($url,$data);
    }
}