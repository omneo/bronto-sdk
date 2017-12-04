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
     * located on the bottom-right part of the page. It is titled “Products API ID”
     *
     * @var string
     */
    protected $productsApiId;

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
     * Make a request.
     *
     * @param $method
     * @param $endpoint
     * @param array $params
     * @return Http\Message\ResponseInterface
     * @throws Exceptions\BrontoException
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
