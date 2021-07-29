<?php

namespace Mohammadv184\ArvanCloud\Tests\Services;

use Mockery\Mock;
use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Adapter\Http;
use Mohammadv184\ArvanCloud\Auth\ApiKey;
use Mohammadv184\ArvanCloud\Response;
use Mohammadv184\ArvanCloud\Services\Cdn\Cdn;
use Mohammadv184\ArvanCloud\Tests\TestCase;

class CdnServiceTest extends TestCase
{
    protected $http;
    protected $config;
    protected function setUp(): void
    {
        $this->config = [
            'baseUrl'  => 'https://napi.arvancloud.com/cdn/4.0/',
            'domain'   => 'example.com',
            'endpoints'=> [
                'domain'=> \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Domain::class,
                'dns'   => \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Dns::class,
                'cache' => \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Cache::class,
                'ssl'   => \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Ssl::class,
            ],
        ];


        $this->http = \Mockery::mock(Adapter::class);
    }
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function testGetAllDomains()
    {
        $httpResponse = $this->getResponse('getAllDomain', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($httpResponse)
            ->with('domains');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->domain()->all();

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('', $response->getMessage());
    }
    public function testGetDomain()
    {
        $httpResponse = $this->getResponse('getDomain', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($httpResponse)
            ->with('domains/example.com');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->domain()->get();

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('', $response->getMessage());
    }
    public function testCreateDomain()
    {
        $httpResponse = $this->getResponse('createDomain', 'cdn');
        $this->http->shouldReceive('post')
            ->andReturn($httpResponse)
            ->with('domains/dns-service', [
                'domain' => 'example.com',
            ]);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->domain()->create('example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
    public function testDeleteDomain()
    {
        $httpResponse = $this->getResponse('deleteDomain', 'cdn');
        $this->http->shouldReceive('delete')
            ->andReturn($httpResponse)
            ->with('domains/example.com?id=497f6eca-6276-4993-bfeb-53cbbbba6f08');
        $getHttpResponse = $this->getResponse('getDomain', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($getHttpResponse)
            ->with('domains/example.com');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->domain()->delete('example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
}
