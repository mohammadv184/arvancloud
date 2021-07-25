<?php


namespace Mohammadv184\ArvanCloud\Exception;


use GuzzleHttp\Exception\RequestException;

class ResponseException extends \Exception
{
    /**
     * Generates a ResponseException from a Guzzle RequestException.
     *
     * @param RequestException $e The client request exception (typically 4xx or 5xx response).
     * @return ResponseException
     */
    public static function fromRequestException(RequestException $e): self
    {
        if (!$e->hasResponse()) {
            return new ResponseException($e->getMessage(), 0, $e);
        }

        $response = $e->getResponse();
        $contentType = $response->getHeaderLine('Content-Type');

        // Attempt to derive detailed error from standard JSON response.
        if (strpos($contentType, 'application/json') !== false) {
            $json = json_decode($response->getBody());
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new ResponseException($e->getMessage(), 0, new JsonException(json_last_error_msg(), 0, $e));
            }

            if (isset($json->errors) && count($json->errors) >= 1) {
                return new ResponseException($json->errors[0]->message, $json->errors[0]->code, $e);
            }
        }

        return new ResponseException($e->getMessage(), 0, $e);
    }
}