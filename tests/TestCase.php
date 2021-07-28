<?php

namespace Mohammadv184\ArvanCloud\Tests;

use Mohammadv184\ArvanCloud\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * get Fake Response.
     *
     * @param string $path
     * @param string $service
     *
     * @return Response
     */
    public function getResponse(string $path, string $service): Response
    {
        $file = file_get_contents(__DIR__.'/FakeResponse/'.$path);

        $responseData = json_decode($file, true);

        $response = new Response($service, $responseData['message'] ?? '');
        $response->data($responseData['data'] ?? $responseData);

        return $response;
    }
}
