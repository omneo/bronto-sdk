<?php

namespace Omneo\Bronto\Modules;

use Omneo\Bronto;

abstract class AbstractSoapModule
{
    /**
     * @var Bronto\SoapClient
     */
    protected $client;

    /**
     * Abstract Module constructor.
     *
     * @param Bronto\SoapClient|null $client
     */
    public function __construct(Bronto\SoapClient $client)
    {
        $this->client = $client;
    }
}
