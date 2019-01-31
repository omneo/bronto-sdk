<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Product;
use Arkade\Bronto\Parsers\ProductParser;
use Arkade\Bronto\Serializers\ProductSerializer;
use Illuminate\Support\Collection;
use League\Csv\Writer;

class ProductService extends AbstractRestModule
{
    /**
     * Product find.
     * Uses product ID
     *
     * @param $id
     * @return Product
     */
    public function find($id)
    {
        return (new ProductParser)->parse(
            $this->client->get(
                'products/public/catalogs/' . $this->client->getProductsApiId() . '/products/' . $id,
                ['debug' => env('APP_DEBUG')]
            )
        );
    }

    /**
     * Product feed import.
     *
     * @param array $products
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function feedImport($products)
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(array_keys(json_decode((new ProductSerializer())->serialize($products[0]), true)));

        foreach ($products as $product) {
            $csv->insertOne(array_values(json_decode((new ProductSerializer())->serialize($product), true)));
        }

        return $this->client->post('products/public/feed_import/', [
            'debug'     => env('APP_DEBUG'),
            'multipart' => [
                [
                    'name'     => 'catalogId',
                    'contents' => $this->client->getProductsApiId()
                ],
                [
                    'name'     => 'feed',
                    'contents' => $csv->__toString()
                ]
            ]
        ]);
    }

    /**
     * Product update.
     *
     * @param $product
     * @return Product
     */
    public function update(Product $product)
    {
        $payload         = new \stdClass();
        $payload->fields = json_decode((new ProductSerializer)->serialize($product));
        $payload         = json_encode([$payload]);

        $this->client->put(
            'products/public/catalogs/' . $this->client->getProductsApiId() . '/products',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'body'    => $payload,
                'debug'   => env('APP_DEBUG')
            ]
        );
    }

}