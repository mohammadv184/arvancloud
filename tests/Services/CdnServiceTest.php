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

    public function testGetCache()
    {
        $httpResponse = $this->getResponse('getCache', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($httpResponse)
            ->with('domains/example.com/caching');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->cache()->get('example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('', $response->getMessage());
    }
    public function testUpdateCache()
    {
        $httpResponse = $this->getResponse('updateCache', 'cdn');
        $data = [
            "f_cache_developer_mode"=> true,
            "f_cache_consistent_uptime"=> true,
            "cache_developer_mode"=> true,
            "cache_consistent_uptime"=> true,
            "cache_status"=> "off",
            "cache_page_200"=> "0s",
            "cache_page_any"=> "0s",
            "cache_browser"=> "default",
            "cache_scheme"=> true,
            "cache_ignore_sc"=> true,
            "cache_cookie"=> "string",
            "cache_args"=> true,
            "cache_arg"=> "filter&sort"
        ];
        $this->http->shouldReceive('patch')
            ->andReturn($httpResponse)
            ->with('domains/example.com/caching', $data);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->cache()->update($data, 'example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
    public function testPurgeCache()
    {
        $httpResponse = $this->getResponse('purgeCache', 'cdn');
        $this->http->shouldReceive('delete')
            ->andReturn($httpResponse)
            ->with('domains/example.com/caching', [
                'purge'      =>  'all',
                'purge_urls' => null,
            ]);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->cache('example.com')->purge();

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }

    public function testGetAllDns()
    {
        $httpResponse = $this->getResponse('getAllDns', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($httpResponse)
            ->with('domains/example.com/dns-records');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->dns()->all('example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('', $response->getMessage());
    }
    public function testCreateDns()
    {
        $httpResponse = $this->getResponse('createDns', 'cdn');

        $data = [
            "type"=> "a",
            "name"=> "string",
            "value"=> [
            [
            "ip"=> "192.168.0.1",
            "port"=> 1,
            "weight"=> 0,
            "country"=> "US"
            ]
                    ],
                    "ttl"=> 120,
                    "cloud"=> false,
                    "upstream_https"=> "default",
                    "ip_filter_mode"=> [
                    "count"=> "single",
                    "order"=> "none",
                    "geo_filter"=> "none"
                    ]
        ];
        $this->http->shouldReceive('post')
            ->andReturn($httpResponse)
            ->with('domains/example.com/dns-records', $data);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->dns()->create($data, 'example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
    public function testGetDns()
    {
        $httpResponse = $this->getResponse('getDns', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($httpResponse)
            ->with('domains/example.com/dns-records/497f6eca-6276-4993-bfeb-53cbbbba6f08');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->dns()->get('497f6eca-6276-4993-bfeb-53cbbbba6f08', 'example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('', $response->getMessage());
    }
    public function testUpdateDns()
    {
        $httpResponse = $this->getResponse('updateDns', 'cdn');

        $data = [
            "type"=> "a",
            "name"=> "string",
            "value"=> [
                [
                    "ip"=> "192.168.0.1",
                    "port"=> 1,
                    "weight"=> 0,
                    "country"=> "US"
                ]
            ],
            "ttl"=> 120,
            "cloud"=> false,
            "upstream_https"=> "default",
            "ip_filter_mode"=> [
                "count"=> "single",
                "order"=> "none",
                "geo_filter"=> "none"
            ]
        ];
        $this->http->shouldReceive('put')
            ->andReturn($httpResponse)
            ->with('domains/example.com/dns-records/497f6eca-6276-4993-bfeb-53cbbbba6f08', $data);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->dns()->update('497f6eca-6276-4993-bfeb-53cbbbba6f08', $data, 'example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
    public function testDeleteDns()
    {
        $httpResponse = $this->getResponse('deleteDns', 'cdn');
        $this->http->shouldReceive('delete')
            ->andReturn($httpResponse)
            ->with('domains/example.com/dns-records/497f6eca-6276-4993-bfeb-53cbbbba6f08');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->dns()->delete('497f6eca-6276-4993-bfeb-53cbbbba6f08', 'example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
    public function testCloudDns()
    {
        $httpResponse = $this->getResponse('cloudDns', 'cdn');
        $this->http->shouldReceive('put')
            ->andReturn($httpResponse)
            ->with('domains/example.com/dns-records/497f6eca-6276-4993-bfeb-53cbbbba6f08/cloud', [
                'cloud' => true
            ]);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->dns()->cloud('497f6eca-6276-4993-bfeb-53cbbbba6f08', true, 'example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }

    public function testGetSsl()
    {
        $httpResponse = $this->getResponse('getSsl', 'cdn');
        $this->http->shouldReceive('get')
            ->andReturn($httpResponse)
            ->with('domains/example.com/ssl');

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->ssl()->get('example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
    public function testUpdateSsl()
    {
        $httpResponse = $this->getResponse('updateSsl', 'cdn');
        $this->http->shouldReceive('patch')
            ->andReturn($httpResponse)
            ->with('domains/example.com/ssl',[
                'ssl_type' => 'off'
            ]);

        $cdn = new Cdn($this->http, $this->config);

        $response = $cdn->ssl()->update('off','example.com');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertIsArray($response->getData());

        $this->assertEquals($httpResponse->getData(), $response->getData());

        $this->assertEquals('cdn', $response->getService());

        $this->assertEquals('string', $response->getMessage());
    }
}
