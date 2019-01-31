<?php

namespace Omneo\Bronto\Modules;

use Omneo\Bronto;

abstract class AbstractRestModule
{
    /**
     * @var Bronto\RestClient
     */
    protected $client;

    /**
     * Abstract Module constructor.
     *
     * @param Bronto\RestClient|null $client
     */
    public function __construct(Bronto\RestClient $client)
    {
        $this->client = $client;
    }
}
