<?php

namespace WebMaster\LaravelPagHiper\Core\Request;

use GuzzleHttp\Client;

class Request
{
    /**
     * @var
     */
    protected $response;

    /**
     * Send a request to PagHiper's API.
     *
     * @param string $endpoint API resource (exemplo: /transaction/create/)
     * @param array $params Resource params. Can be found at: https://dev.paghiper.com/reference
     */
    public function __construct(string $endpoint = '', array $params = [])
    {
        $client = new Client([
            'base_uri' => 'https://api.paghiper.com',
            'defaults' => [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Charset' => 'UTF-8',
                    'Accept-Encoding' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ],
        ]);

        //  Add token and apiKey
        $params = array_merge([
            'token' => config('paghiper.token'),
            'apiKey' => config('paghiper.apiKey'),
        ], $params);

        // Send the request
        $request = $client->request('POST', $endpoint, [
            'json' => $params,
        ]);

        $this->response = json_decode($request->getBody(), true);

        return $this;
    }

    /**
     * Pega a resposta do PagHiper.
     *
     * @return void
     */
    public function getResponse()
    {
        return $this->response;
    }
}
