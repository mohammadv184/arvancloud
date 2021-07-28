<?php

namespace Mohammadv184\ArvanCloud\Tests\Adapter;

use Mohammadv184\ArvanCloud\Adapter\Adapter;
use Mohammadv184\ArvanCloud\Adapter\Http;
use Mohammadv184\ArvanCloud\Auth\ApiKey;
use Mohammadv184\ArvanCloud\Exception\ResponseException;
use Mohammadv184\ArvanCloud\Response;
use Mohammadv184\ArvanCloud\Tests\TestCase;

class HttpTest extends TestCase
{
    protected $http;

    protected function setUp(): void
    {
        $auth = new ApiKey('ApiKey test1654861648jbhkjniyb');

        $this->http = new Http($auth, 'https://httpbin.org/', static::class);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Adapter::class, $this->http);
    }

    public function testGet()
    {
        $data = [
            'foo' => 'bar',

            'message' => 'ok!',
        ];

        $response = $this->http->get('get', $data);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals(static::class, $response->getService());

        $this->assertEquals($data, $response->getData()['args']);

        $this->assertArrayHasKey('Authorization', $response->getData()['headers']);

        $this->assertEquals('ApiKey test1654861648jbhkjniyb', $response['headers']['Authorization']);
    }

    public function testPost()
    {
        $data = [
            'foo' => 'bar',

            'message' => 'ok!',
        ];

        $response = $this->http->post('post', $data);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals(static::class, $response->getService());

        $this->assertEquals($data, $response->getData()['json']);

        $this->assertArrayHasKey('Authorization', $response->getData()['headers']);

        $this->assertEquals('ApiKey test1654861648jbhkjniyb', $response['headers']['Authorization']);
    }

    public function testPatch()
    {
        $data = [
            'foo' => 'bar',

            'message' => 'ok!',
        ];

        $response = $this->http->patch('patch', $data);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals(static::class, $response->getService());

        $this->assertEquals($data, $response->getData()['json']);

        $this->assertArrayHasKey('Authorization', $response->getData()['headers']);

        $this->assertEquals('ApiKey test1654861648jbhkjniyb', $response['headers']['Authorization']);
    }

    public function testDelete()
    {
        $data = [
            'foo' => 'bar',

            'message' => 'ok!',
        ];

        $response = $this->http->delete('delete', $data);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals(static::class, $response->getService());

        $this->assertEquals($data, $response->getData()['json']);

        $this->assertArrayHasKey('Authorization', $response->getData()['headers']);

        $this->assertEquals('ApiKey test1654861648jbhkjniyb', $response['headers']['Authorization']);
    }

    public function testError404()
    {
        $this->expectException(ResponseException::class);

        $this->http->get('status/404');
    }

    public function testServerError()
    {
        $this->expectException(ResponseException::class);

        $this->http->get('status/500');
    }
}
