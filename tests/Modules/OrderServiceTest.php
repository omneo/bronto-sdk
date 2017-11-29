<?php

namespace Arkade\Bronto\Modules;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Arkade\Bronto\Entities\Order;
use Arkade\Bronto\Factories;
use PHPUnit\Framework\TestCase;
use Arkade\Bronto\InteractsWithClient;

class OrderServiceTest extends TestCase
{
    use InteractsWithClient;

    /**
     * @test
     */
    public function order_find()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                [
                    file_get_contents(__DIR__.'../../Stubs/Orders/order.json')
                ]
            ]))
        ], $history);

        $order = (new Factories\OrderFactory)->make();
        $response = $client->orderService()->add($order);

        var_dump($response);
    }

}