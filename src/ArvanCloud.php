<?php

namespace Mohammadv184\ArvanCloud;

use Mohammadv184\ArvanCloud\Adapter\Http;
use Mohammadv184\ArvanCloud\Auth\ApiKey;
use Mohammadv184\ArvanCloud\Auth\UserToken;
use Mohammadv184\ArvanCloud\Exception\InvalidArgument;

class ArvanCloud
{
    protected $config;
    public function __construct(array $config = null)
    {
        $this->config=$config;
    }

    /**
     * @throws InvalidArgument
     */
    public static function __callStatic($name, $arguments)
    {
        $config = (new ArvanCloud)->loadConfig();


        if (!isset($config['map'][strtolower($name)])){
            throw new InvalidArgument("invalid Service {$name}");
        }
        $service = $config['map'][strtolower($name)];
        $auth = $config['auth']['default']=='ApiKey'
            ?new ApiKey($config['auth']['ApiKey'])
            :new UserToken();
        $http= new Http($auth,$config['services'][strtolower($name)]['baseUrl'],$service);
        return new $config['map'][strtolower($name)]($http,$config['services'][strtolower($name)],...$arguments);
    }
    protected function loadConfig():array
    {
        return require('config/arvancloud.php');
    }

}