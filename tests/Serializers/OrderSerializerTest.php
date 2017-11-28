<?php

namespace Arkade\Bronto\Serializers;

use PHPUnit\Framework\TestCase;
use Arkade\Bronto\Factories;

class OrderSerializerTest extends TestCase
{
    /**
     * @test
     */
    public function returns_populated_json()
    {
        $json = (new OrderSerializer)->serialize(
            (new Factories\OrderFactory)->make()
        );

        $this->assertEquals(file_get_contents(__DIR__.'/../Stubs/Orders/create_order_request.json'), $json);
    }
}