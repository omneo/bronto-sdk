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
     * Product feed import.
     *
     * @param array $products
     * @return string transaction UUID
     */
    public function feedImport($products)
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(array_keys(json_decode(json_encode($products[0]),true)));

        foreach($products as $product){
            $csv->insertOne(array_values(json_decode((new ProductSerializer())->serialize($product),true)));
        }

        return $this->client->post('products/public/feed_import/',['debug' => true, 'multipart' => [
            [
                'name' => 'catalogId',
                'contents' => $this->client->getProductsApiId()
            ],
            [
                'name' => 'feed',
                'contents' => $csv->__toString()
            ]
        ]
        ]);
    }

    /**
     * Product find.
     * Uses product ID
     *
     * @param $id
     * @return Product
     */
    public function findById($id)
    {
        return (new ProductParser)->parse(
            $this->client->get('products/public/catalogs/'.$this->client->getProductsApiId().'/products/'.$id,['debug' => true])
        );
    }

    /**
     * Get all Products.
     *
     * @param $id
     * @return Collection
     */
    public function all()
    {
        $data = $this->client->get('products/public/catalogs/'.$this->client->getProductsApiId().'/products',['debug' => true]);

        $collection = new Collection;

        if(!count($data)) return $collection;

        foreach($data as $item){
            $collection->push(
                (new ProductParser)->parse($item)
            );
        }

        return $collection;
    }

}