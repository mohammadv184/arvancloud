<?php

namespace Mohammadv184\ArvanCloud\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mohammadv184\ArvanCloud\Auth\Auth;
use Mohammadv184\ArvanCloud\Exception\ResponseException;
use Mohammadv184\ArvanCloud\Response;

class Http implements Adapter
{
    /**
     * guzzle http client.
     *
     * @var Client
     */
    protected $client;

    /**
     * ArvanCloud Service.
     *
     * @var string
     */
    protected $service;

    /**
     * Http constructor.
     *
     * @param Auth   $auth
     * @param string $baseUrl
     * @param string $service
     */
    public function __construct(Auth $auth, string $baseUrl, string $service)
    {
        $this->service = $service;
        $headers = $auth->getHeaders();

        $this->client = new Client([
            'base_uri'       => $baseUrl,
            'headers'        => $headers,
            'Accept'         => 'application/json',
            'allow_redirects'=> false,
        ]);
    }

    /**
     * Sends a GET request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function get(string $url, array $data = [], array $headers = []): Response
    {
        return $this->request('GET', $url, $data, $headers);
    }

    /**
     * Sends a Post request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function post(string $url, array $data = [], array $headers = []): Response
    {
        return $this->request('POST', $url, $data, $headers);
    }

    /**
     * Sends a Put request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function put(string $url, array $data = [], array $headers = []): Response
    {
        return $this->request('PUT', $url, $data, $headers);
    }

    /**
     * Sends a Patch request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function patch(string $url, array $data = [], array $headers = []): Response
    {
        return $this->request('PATCH', $url, $data, $headers);
    }

    /**
     * Sends a Delete request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function delete(string $url, array $data = [], array $headers = []): Response
    {
        return $this->request('DELETE', $url, $data, $headers);
    }

    /**
     * Sends a request.
     *
     * @param string $method
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function request(string $method, string $url, array $data = [], array $headers = []): Response
    {
        try {
            $response = $this->client->request($method, $url, [
                'headers'                             => $headers,
                ($method == 'GET' ? 'query' : 'json') => $data,
            ]);
        } catch (RequestException $e) {
            throw ResponseException::fromRequestException($e);
        }

        $responseData = json_decode($response->getBody()->getContents(), true);

        return $this->response(isset($responseData['data'])&&is_array($responseData['data'])
            ?$responseData['data']
            :$responseData, $responseData['message'] ?? null);
    }

    /**
     * Return Response.
     *
     * @param array  $data
     * @param string $message
     *
     * @return Response
     */
    protected function response(array $data, string $message=null): Response
    {
        $r = new Response($this->service, $message);
        $r->data($data);

        return $r;
    }
}
