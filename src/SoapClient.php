<?php

namespace Arkade\Bronto;

class SoapClient
{
    /**
     * @var Bronto_Api
     */
    protected $client;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $listId;

    /**
     * Client constructor.
     *
     */
    public function __construct()
    {
        $this->client = new \Bronto_Api();
    }

    /**
     * @return Bronto_Api
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Bronto_Api $client
     * @return SoapClient
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return SoapClient
     */
    public function setToken($token)
    {
        $this->token = $token;
        $this->client->setToken($token);
        $this->client->login();
        return $this;
    }

    /**
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param string $listId
     * @return SoapClient
     */
    public function setListId($listId)
    {
        $this->listId = $listId;
        return $this;
    }

    /**
     * Contact service module.
     *
     * @return Modules\ContactService
     */
    public function contactService()
    {
        return new Modules\ContactService($this);
    }

}
