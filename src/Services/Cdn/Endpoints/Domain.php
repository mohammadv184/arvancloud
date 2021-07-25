<?php


namespace Mohammadv184\ArvanCloud\Services\Cdn\Endpoints;


use Mohammadv184\ArvanCloud\Adapter\Adapter;
use phpDocumentor\Reflection\PseudoTypes\True_;

class Domain
{
    protected $http;

    protected $domain;

    public function __construct(Adapter $http,string $defaultDomain , string $domain = null)
    {
        $this->http = $http;

        $this->domain = $domain??$defaultDomain;
    }
    public function all(){
        return json_decode($this->http->get('domains')->getBody()->getContents(),true)['data'];
    }
    public function create($domain){
        return $this->http->post('domains/dns-service',[
           'domain' =>  $domain
        ])->getBody()->getContents();
    }
    public function get($domain=null){
        $url = 'domains/'.($domain ?? $this->domain);
        return json_decode($this->http->get($url)->getBody()->getContents(),true)['data'];
    }
    public function delete($domain = null){
        $id = $this->get($domain ?? $this->domain)['id'];
        $url = 'domains/'.($domain ?? $this->domain)."?id=$id";
        return json_decode($this->http->delete($url)->getBody()->getContents(),true);
    }
}