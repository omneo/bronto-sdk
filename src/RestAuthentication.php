<?php

namespace Arkade\Bronto;

use GuzzleHttp;
use Carbon\Carbon;

class RestAuthentication
{
    /**
     * Guzzle client.
     *
     * @var GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * Auth URL.
     *
     * @var string
     */
    protected $authUrl;

    /**
     * Client ID.
     *
     * @var string
     */
    protected $clientId;

    /**
     * Client Secret.
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Token.
     *
     * @var string
     */
    protected $token;

    /**
     * Token expiry.
     *
     * @var string
     */
    protected $tokenExpiry;

    /**
     * Refresh Token.
     *
     * @var string
     */
    protected $refreshToken;

    /**
     * Authentication constructor.
     *
     * @param GuzzleHttp\HandlerStack $handler
     */
    public function __construct(GuzzleHttp\HandlerStack $handler = null)
    {
        $this->guzzle = new GuzzleHttp\Client([
            'handler' => $handler ? $handler : GuzzleHttp\HandlerStack::create(),
        ]);
    }

    /**
     * Set the auth URL.
     *
     * @param string $authUrl
     * @return $this
     */
    public function setAuthUrl($authUrl)
    {
        $this->authUrl = $authUrl;

        return $this;
    }

    /**
     * Get the auth URL.
     *
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->authUrl;
    }

    /**
     * Set the client ID.
     *
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get the client ID.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set the client secret.
     *
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Get the client secret.
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Set the endpoint.
     *
     * @param string $url
     * @return $this
     */
    public function setEndpoint($url)
    {
        $this->endpoint = $url;

        return $this;
    }

    /**
     * Get the endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Get a token.
     *
     * @return string
     */
    public function getToken()
    {
        if ($this->token) return $this->isTokenExpired() ? $this->refreshOauthToken() : $this->token;

        return $this->createOauthToken();
    }

    /**
     * Set the token.
     *
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the token expiry.
     *
     * @return mixed
     */
    public function getTokenExpiry()
    {
        return $this->tokenExpiry;
    }

    /**
     * Set token expiry.
     *
     * @param $tokenExpiry
     * @return $this
     */
    public function setTokenExpiry($tokenExpiry)
    {
        $this->tokenExpiry = $tokenExpiry;

        return $this;
    }

    /**
     * Get the refresh token.
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set the refresh token.
     *
     * @param $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Create oauth token.
     *
     * @return string
     */
    public function createOauthToken()
    {
        $params = [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ],
        ];

        // Make the Request and process the response
        $response = $this->guzzle->request('POST', $this->getAuthUrl(), $params);
        $result = json_decode((string) $response->getBody());

        $this->setToken($result->access_token)
             ->setTokenExpiry(
                 Carbon::now()
                     ->addSeconds($result->expires_in)
             )
             ->setRefreshToken($result->refresh_token);

        return $this->token;
    }

    /**
     * Refresh oauth token.
     *
     * @return string
     */
    public function refreshOauthToken()
    {
        // Setup our auth parameters
        $params = [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'refresh_token' => $this->refreshToken,
            ],
        ];

        // Make the Request and process the response
        $response = $this->guzzle->request('POST', $this->getAuthUrl(), $params);
        $result = json_decode((string) $response->getBody());

        $this->setToken($result->access_token)
             ->setTokenExpiry(
                 Carbon::now()
                     ->addSeconds($result->expires_in)
             )
             ->setRefreshToken($result->refresh_token);

        return $this->token;
    }

    /**
     * Determine if a token has expired.
     *
     * @return bool
     */
    public function isTokenExpired()
    {
        return Carbon::now()->greaterThanOrEqualTo($this->getTokenExpiry()->subMinutes(5));
    }
}
