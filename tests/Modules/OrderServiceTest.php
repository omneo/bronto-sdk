<?php

namespace Arkade\Bronto\Modules;

use GuzzleHttp\Psr7\Response;
use Arkade\Bronto\Factories;
use PHPUnit\Framework\TestCase;
use Arkade\Bronto\InteractsWithClient;
use Arkade\Bronto\Entities\Order;
use Illuminate\Support\Collection;

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
            new Response(200, ['Content-Type' => 'application/json'],
                file_get_contents(__DIR__.'../../Stubs/Orders/order.json')
            )
        ], $history);

        $response = $client->orderService()->find('52e2ba9d-b339-4859-aeec-43a79cf6bfd7');

        $this->assertInstanceOf(Order::class, $response);

    }

    /**
     * @test
     */
    public function order_find_by_id()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, ['Content-Type' => 'application/json'],
                '[' . file_get_contents(__DIR__.'../../Stubs/Orders/order.json') . ']'
            )
        ], $history);

        $response = $client->orderService()->findById('ORDER-123456789');

        $this->assertInstanceOf(Collection::class, $response);

    }

    /**
     * @test
     */
    public function order_add()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, ['Content-Type' => 'application/json'],
                file_get_contents(__DIR__.'../../Stubs/Orders/order.json')
            )
        ], $history);

        $order = (new Factories\OrderFactory)->make();
        $response = $client->orderService()->add($order);

        $this->assertInstanceOf(Order::class, $response);

    }

    /**
     * @test
     */
    public function order_update()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, ['Content-Type' => 'application/json'],
                file_get_contents(__DIR__.'../../Stubs/Orders/order.json')
            )
        ], $history);

        $order = (new Factories\OrderFactory)->make();
        $response = $client->orderService()->update($order);

        $this->assertInstanceOf(Order::class, $response);

    }

    /**
     * @test
     */
    public function order_update_by_id()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, ['Content-Type' => 'application/json'],
                file_get_contents(__DIR__.'../../Stubs/Orders/order.json')
            )
        ], $history);

        $order = (new Factories\OrderFactory)->make();
        $response = $client->orderService()->updateById($order);

        $this->assertInstanceOf(Order::class, $response);

    }

    /**
     * @test
     */
    public function order_delete()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(204, [], null
            )
        ], $history);

        $response = $client->orderService()->delete('52e2ba9d-b339-4859-aeec-43a79cf6bfd7');

        $this->assertNull($response);

    }

    /**
     * @test
     */
    public function order_delete_by_id()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(204, [], null
            )
        ], $history);

        $response = $client->orderService()->deleteById('ORDER-123456789');

        $this->assertNull($response);

    }

}