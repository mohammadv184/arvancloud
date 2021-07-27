<?php

namespace Mohammadv184\ArvanCloud;

use Mohammadv184\ArvanCloud\Adapter\Http;
use Mohammadv184\ArvanCloud\Auth\ApiKey;
use Mohammadv184\ArvanCloud\Auth\UserToken;
use Mohammadv184\ArvanCloud\Exception\InvalidArgument;
use Mohammadv184\ArvanCloud\Services\Cdn\Cdn;

/**
 * Class ArvanCloud.
 *
 * @method static Cdn cdn()
 */
class ArvanCloud
{
    /**
     * ArvanCloud Configs.
     *
     * @var array|null
     */
    protected $config;

    /**
     * ArvanCloud constructor.
     *
     * @param array|null $config
     */
    public function __construct(array $config = null)
    {
        $this->config = $config;
    }

    /**
     * Call Services.
     *
     * @param $name
     * @param $arguments
     *
     * @throws InvalidArgument
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $config = $this->config ?? $this->loadConfig();

        if (!isset($config['map'][strtolower($name)])) {
            throw new InvalidArgument("invalid Service {$name}");
        }
        $service = $config['map'][strtolower($name)];
        $auth = $config['auth']['default'] == 'ApiKey'
            ? new ApiKey($config['auth']['ApiKey'])
            : new UserToken();
        $http = new Http($auth, $config['services'][strtolower($name)]['baseUrl'], $service);

        return new $config['map'][strtolower($name)]($http, $config['services'][strtolower($name)], ...$arguments);
    }

    /**
     * Call Static Services.
     *
     * @param $name
     * @param $arguments
     *
     * @throws InvalidArgument
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $config = (new ArvanCloud())->loadConfig();

        if (!isset($config['map'][strtolower($name)])) {
            throw new InvalidArgument("invalid Service {$name}");
        }
        $service = $config['map'][strtolower($name)];
        $auth = $config['auth']['default'] == 'ApiKey'
            ? new ApiKey($config['auth']['ApiKey'])
            : new UserToken();
        $http = new Http($auth, $config['services'][strtolower($name)]['baseUrl'], $service);

        return new $config['map'][strtolower($name)]($http, $config['services'][strtolower($name)], ...$arguments);
    }

    /**
     * Load ArvanCloud Configs.
     *
     * @return array
     */
    protected function loadConfig(): array
    {
        return require __DIR__.'/config/arvancloud.php';
    }
}
