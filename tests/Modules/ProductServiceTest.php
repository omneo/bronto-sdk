<?php

namespace Arkade\Bronto\Modules;

use GuzzleHttp\Psr7\Response;
use Arkade\Bronto\Factories;
use PHPUnit\Framework\TestCase;
use Arkade\Bronto\InteractsWithClient;
use Arkade\Bronto\Entities\Product;
use Illuminate\Support\Collection;

class ProductServiceTest extends TestCase
{
    use InteractsWithClient;

    /**
     * @test
     */
    public function product_find()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, ['Content-Type' => 'application/json'],
                file_get_contents(__DIR__.'../../Stubs/Products/product.json')
            )
        ], $history);

        $response = $client->productService()->find('9330947716452');

        $this->assertInstanceOf(Product::class, $response);

    }

    /**
     * @test
     */
    public function product_feed_import()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, [], null
            )
        ], $history);

        $products = (new Factories\ProductsFactory)->make();
        $response = $client->productService()->feedImport($products);

        $this->assertNull($response);

    }

    /**
     * @test
     */
    public function product_update()
    {
        // Create the container.
        $history = [];

        // Create a mock response object.
        $client = $this->createClient([
            new Response(200, [], null
            )
        ], $history);

        $product = (new Factories\ProductFactory)->make();
        $response = $client->productService()->update($product);

        $this->assertNull($response);

    }

}