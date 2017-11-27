<?php

namespace Arkade\Bronto;

use Psr\Http;
use GuzzleHttp;
use GuzzleHttp\Middleware;
use Arkade\Bronto;

class RestClient
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var Bronto\RestAuthentication
     */
    protected $auth;

    /**
     * Client constructor.
     *
     * @param RestAuthentication $auth
     * @param GuzzleHttp\HandlerStack|null $handler
     */
    public function __construct(Bronto\RestAuthentication $auth, GuzzleHttp\HandlerStack $handler = null)
    {
        $this->auth = $auth;

        $this->client = new GuzzleHttp\Client([
            'handler' => $handler ? $handler : GuzzleHttp\HandlerStack::create(),
        ]);
    }

    /**
     * Make a request.
     *
     * @param $method
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     * @throws Exceptions\UnexpectedException
     */
    public function request($method, $endpoint, array $params = [])
    {
        $headers = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->auth->getToken(),
            ],
        ];

        $clientHandler = $this->client->getConfig('handler');
        $tapMiddleware = Middleware::tap(function ($request) {
            echo 'tap: ' . $request->getBody();
        });
        $params['handler'] = $tapMiddleware($clientHandler);

        try {
            $response = $this->client->request(
                $method,
                $this->auth->getEndpoint() . '/' . $endpoint,
                array_merge($headers, $params)
            );
        } catch (GuzzleHttp\Exception\RequestException $e) {
            //            var_dump($e->getResponse()->getBody());
//            var_dump($e->getResponse()->getStatusCode());
//            var_dump($e->getResponse()->getHeader('X-Reason'));
            throw new Exceptions\UnexpectedException((string) $e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        }

        return json_decode((string) $response->getBody());
    }

    /**
     * Perform a GET request.
     *
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     */
    public function get($endpoint, array $params = [])
    {
        return $this->request('GET', $endpoint, $params);
    }

    /**
     * Perform a POST request.
     *
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     */
    public function post($endpoint, array $params = [])
    {
        return $this->request('POST', $endpoint, $params);
    }

    /**
     * Perform a PUT request.
     *
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     */
    public function put($endpoint, array $params = [])
    {
        return $this->request('PUT', $endpoint, $params);
    }

    /**
     * Perform a DELETE request.
     *
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     */
    public function delete($endpoint, array $params = [])
    {
        return $this->request('DELETE', $endpoint, $params);
    }

    /**
     * Order service module.
     *
     * @return Modules\OrderService
     */
    public function orderService()
    {
        return new Modules\OrderService($this);
    }

}
