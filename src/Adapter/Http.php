<?php


namespace Mohammadv184\ArvanCloud\Adapter;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mohammadv184\ArvanCloud\Auth\Auth;
use Mohammadv184\ArvanCloud\Exception\ResponseException;
use Psr\Http\Message\ResponseInterface;

class Http implements Adapter
{
    protected $client;

    public function __construct(Auth $auth, string $baseUrl)
    {
        $headers = $auth->getHeaders();

        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => $headers,
            'Accept' => 'application/json',
            'allow_redirects'=>false
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ResponseException
     */
    public function get(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('GET',$url,$data,$headers);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ResponseException
     */
    public function post(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('POST',$url,$data,$headers);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ResponseException
     */
    public function put(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('PUT',$url,$data,$headers);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ResponseException
     */
    public function patch(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('PATCH',$url,$data,$headers);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ResponseException
     */
    public function delete(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('DELETE',$url,$data,$headers);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ResponseException
     */
    public function request(string $method , string $url , array $data = [], array $headers = []): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $url, [
                'headers' => $headers,
                ($method == 'GET' ? 'query' : 'json') => $data
            ]);
        }catch (RequestException $e){
            throw ResponseException::fromRequestException($e);
        }

        return $response;

    }
}