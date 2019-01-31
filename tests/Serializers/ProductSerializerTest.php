<?php

namespace Arkade\Bronto\Serializers;

use PHPUnit\Framework\TestCase;
use Arkade\Bronto\Factories;

class ProductSerializerTest extends TestCase
{
    /**
     * @test
     */
    public function returns_populated_json()
    {
        $json = (new ProductSerializer)->serialize(
            (new Factories\ProductFactory)->make()
        );

        $this->assertEquals(file_get_contents(__DIR__.'/../Stubs/Products/serialized_product.json'), $json);
    }
}