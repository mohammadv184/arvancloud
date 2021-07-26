<?php


namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;


use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Services\Cdn\Endpoint;

class Dns extends Endpoint
{

    public function all(string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/dns-records';

        return $this->http->get($url);
    }
    public function create(array $data ,string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/dns-records';

        return $this->http->post($url,$data);
    }
    public function get($id ,string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/dns-records/'.$id;

        return $this->http->get($url);
    }
    public function update($id ,array $data,string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/dns-records/'.$id;

        return $this->http->put($url,$data);
    }
    public function delete($id ,string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/dns-records/'.$id;

        return $this->http->delete($url);
    }
    public function cloud($id,bool $status=true ,string $domain=null){
        $url = 'domains/'.($domain??$this->domain).'/dns-records/'.$id.'/cloud';

        return $this->http->put($url,[
            'cloud'=>$status
        ]);
    }
}