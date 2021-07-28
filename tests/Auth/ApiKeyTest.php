<?php

namespace Mohammadv184\ArvanCloud\Tests\Auth;

use Mohammadv184\ArvanCloud\Auth\ApiKey;
use Mohammadv184\ArvanCloud\Auth\Auth;
use Mohammadv184\ArvanCloud\Tests\TestCase;

class ApiKeyTest extends TestCase
{
    protected $apiKey;

    protected function setUp(): void
    {
        $this->apiKey = new ApiKey('ApiKey test1654861648jbhkjniyb');
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Auth::class, $this->apiKey);
    }

    public function testGetHeaders()
    {
        $this->assertIsArray($this->apiKey->getHeaders());

        $this->assertArrayHasKey('Authorization', $this->apiKey->getHeaders());

        $this->assertCount(1, $this->apiKey->getHeaders());

        $this->assertEquals([
            'Authorization' => 'ApiKey test1654861648jbhkjniyb',
        ], $this->apiKey->getHeaders());
    }
}
