<?php


namespace Mohammadv184\ArvanCloud\Adapter;


use Mohammadv184\ArvanCloud\Auth\Auth;
use Psr\Http\Message\ResponseInterface;

interface Adapter
{
    /**
     * Adapter constructor.
     *
     * @param Auth $auth
     * @param string $baseUrl
     */
    public function __construct(Auth $auth, string $baseUrl);

    /**
     * Sends a GET request.
     * Per Robustness Principle - not including the ability to send a body with a GET request (though possible in the
     * RFCs, it is never useful).
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return mixed
     */
    public function get(string $url, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return mixed
     */
    public function post(string $url, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return mixed
     */
    public function put(string $url, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return mixed
     */
    public function patch(string $url, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return mixed
     */
    public function delete(string $url, array $data = [], array $headers = []): ResponseInterface;

}