<?php

namespace Omneo\Bronto;

use Bronto_Api;
use Illuminate\Support\Collection;

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
     * @var Collection
     */
    protected $contactMappings;

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
     * @return Collection
     */
    public function getContactMappings()
    {
        return $this->contactMappings;
    }

    /**
     * @param Collection $contactMappings
     * @return SoapClient
     */
    public function setContactMappings($contactMappings)
    {
        $this->contactMappings = $contactMappings;
        return $this;
    }

    /**
     * Contact service module.
     *
     * @return Modules\ContactService
     */
    public function contactService()
    {
        return new Modules\ContactService($this, $this->contactMappings);
    }

    /**
     * Delivery service module.
     *
     * @return Modules\DeliveryService
     */
    public function deliveryService()
    {
        return new Modules\DeliveryService($this);
    }

}
