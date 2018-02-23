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
     * Products API ID
     * This ID can be found on the Products Overview page in the BMP,
     * located on the bottom-right part of the page. It is titled 'Products API ID'
     *
     * @var string
     */
    protected $productsApiId;

    /**
     * Verify peer SSL
     *
     * @var bool
     */
    protected $verifyPeer = true;

    /**
     * Set connection timeout
     *
     * @var int
     */
    protected $timeout = 900;

    /**
     * Client constructor.
     *
     * @param RestAuthentication $auth
     * @param GuzzleHttp\HandlerStack|null $handler
     */
    public function __construct(Bronto\RestAuthentication $auth, GuzzleHttp\HandlerStack $handler = null)
    {
        $this->auth = $auth;

        $this->setupClient($handler);
    }

    /**
     * Set the product API ID.
     *
     * @param string $id
     * @return $this
     */
    public function setProductsApiId($id)
    {
        $this->productsApiId = $id;

        return $this;
    }

    /**
     * Get the product API ID.
     *
     * @return string
     */
    public function getProductsApiId()
    {
        return $this->productsApiId;
    }

    /**
     * @return bool
     */
    public function getVerifyPeer()
    {
        return $this->verifyPeer;
    }

    /**
     * @param bool $verifyPeer
     * @return RestClient
     */
    public function setVerifyPeer($verifyPeer)
    {
        $this->verifyPeer = $verifyPeer;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     * @return RestClient
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }



    /**
     * Setup Guzzle client with optional provided handler stack.
     *
     * @param  GuzzleHttp\HandlerStack|null $stack
     * @param  array                        $options
     * @return Client
     */
    public function setupClient(GuzzleHttp\HandlerStack $stack = null, $options = [])
    {
        $stack = $stack ?: GuzzleHttp\HandlerStack::create();

        $this->client = new GuzzleHttp\Client(array_merge([
            'handler'  => $stack,
            'verify' => $this->getVerifyPeer(),
            'timeout'  => $this->getTimeout(),
        ], $options));

        return $this;
    }

    /**
     * Make a request.
     *
     * @param $method
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     * @throws Exceptions\BrontoException
     * @throws Exceptions\NotFoundException
     */
    public function request($method, $endpoint, array $params = [])
    {
        $clientHandler = $this->client->getConfig('handler');
        $oauthMiddleware = Middleware::mapRequest(function ($request) {
            return $request->withHeader('Authorization','Bearer ' . $this->auth->getToken());
        });
        $params['handler'] = $oauthMiddleware($clientHandler);

        try {
            $response = $this->client->request(
                $method,
                $this->auth->getEndpoint() . '/' . $endpoint,
                $params
            );
        } catch (\Exception $e) {
            var_dump($e->getMessage());exit;
            throw $this->convertException($e);
        }

        return json_decode((string) $response->getBody());
    }

    /**
     * Convert the provided exception.
     *
     * @param  Exception $e
     * @return Exceptions\NotFoundException|Exceptions\BrontoException|Exception
     */
    protected function convertException(\Exception $e)
    {
        if ($e instanceof GuzzleHttp\Exception\ClientException && $e->getResponse()->getStatusCode() == 404) {
            return new Exceptions\NotFoundException('not found');
        }

        if ($e instanceof GuzzleHttp\Exception\BadResponseException) {
            $message = (string) $e->getResponse()->getBody();
            if(count($e->getResponse()->getHeader('X-Reason'))){
                $message = (string) $e->getResponse()->getHeader('X-Reason')[0];
            }
            return new Exceptions\BrontoException($message, $e->getResponse()->getStatusCode());
        }

        return $e;
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

    /**
     * Product service module.
     *
     * @return Modules\ProductService
     */
    public function productService()
    {
        return new Modules\ProductService($this);
    }

}
